<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Custom\ApiResponse;
use App\Models\Dispatcher;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //

    public function saveOrders(Request $request)
    {
        $userId = auth()->id(); // Logged-in user ID
        $cartItems = $request->input('cartItems');
        $transaction_id = $request->input('transaction_id');
       
        foreach ($cartItems as $cartItem) {
            // Insert into orders table
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'vendor_id' => $cartItem['services'] === 'Restaurant' ? $cartItem['restaurant_id'] : ($cartItem['services'] === 'Laundry' ? $cartItem['laundry_id'] : null),
                'service_type' => $cartItem['services'],
                'item_amount' => $cartItem['itemAmount'],
                'delivery_fee' => isset($cartItem['deliveryFee']['price']) ? $cartItem['deliveryFee']['price'] : 0,
                'delivery_landmark' => isset($cartItem['deliveryFee']['landmark']) ? $cartItem['deliveryFee']['landmark'] : null,
                'total_amount' => $cartItem['totalAmount'],
                'trans_id' => $transaction_id,
                'form_details' => json_encode($cartItem['formDetails']),
                 'items' => json_encode($cartItem['items']),
                'status' => 'Make Payment',
               
                'created_at' => Carbon::now(),
            ]);

            // Insert into cart_items table
            foreach ($cartItem['items'] as $item) {
                DB::table('cart_items')->insert([
                    'order_id' => $orderId,
                    'items_id'=>$item['item_id'] ?? null,
                    'description' => $item['description'] ?? $item['name'] ?? $item,
                    'quantity' => $item['quantity'] ?? 1,
                    'rate' => $item['rate'] ?? $item['price'] ?? null,
                    'pricePerItem' => $item['pricePerItem'] ?? 0.00,
                    'serviceName' => $item['serviceName'] ?? null,

                ]);
            }
        }

        return response()->json(['message' => 'Orders saved successfully!']);
    }

    public function getUserOrders(Request $request)
    {
        $user = auth()->user();
        

        // Fetch orders with restaurant name when restaurant_id is present
        $orders = $user->orders()->select('id', 'service_type', 'item_amount', 'delivery_fee','delivery_landmark', 'total_amount', 'status', 'vendor_id', 'created_at')
            ->with(['vendor:id,name']) // Load the vendor's name
            ->get()
            ->map(function ($order) {
                $order->vendor_name = $order->vendor_name ? $order->vendor->name : null;
                unset($order->restaurant); // Remove the extra object
                return $order;
            });

        // Return the orders in a structured response
        return ApiResponse::success($orders, 'Orders fetched successfully');
    }

    private function getRestaurantId($restaurantName)
    {
        return DB::table('vendors')->where('name', $restaurantName)->value('id');
    }

    public function updateOrder(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'trans_id' => 'required|string', // Transaction ID is required
            'tx_ref' => 'required|string',  // Reference to update
            'status' => 'required|string',  // Status to update
        ]);

        // dd($request->input('status'));
         $status = $request->input('status');
        if($status=='successful'){
             $status='Processing';
        }else{
             $status = $request->input('status');
        }

        // Update the order in the database
        $updated = DB::table('orders')
            ->where('trans_id', $validated['trans_id']) // Match by transaction ID
            ->update([
                'tx_ref' => $validated['tx_ref'],
                'status' =>  $status,
                'updated_at' => Carbon::now(), // Update the timestamp
            ]);

        // Check if any rows were updated
        if ($updated) {

             if($status=='successful' || $status=='Processing'){
              return ApiResponse::success(null, 'Order Placed successfully!');
            }else{
                return ApiResponse::notFound('Transaction Failed.');
            }

        }

        return ApiResponse::notFound('Order not found or no changes made.');
    }


    public function webhookupdateOrder(Request $request)
    {
        // Verify Paystack signature
        $signature = $request->header('x-paystack-signature');
        if (!$signature || $signature !== hash_hmac('sha512', $request->getContent(), env('PAYSTACK_SECRET_KEY'))) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $payload = $request->all();

        // Always log webhook events for debugging
        Log::channel('paystack')->info('Paystack Webhook Event', $payload);

        if (!isset($payload['event'])) {
            return response()->json(['message' => 'No event found'], 400);
        }

        $event = $payload['event'];
        $data  = $payload['data'] ?? [];

        switch ($event) {
            case 'charge.success':
                $this->updateOrderStatus($data, 'Processing');
                return response()->json(['message' => 'Charge success processed'], 200);

            case 'charge.failed':
                $this->updateOrderStatus($data, 'Failed');
                return response()->json(['message' => 'Charge failed processed'], 200);

            case 'transfer.success':
                $this->updateOrderStatus($data, 'Processing');
                return response()->json(['message' => 'Transfer success processed'], 200);

            case 'transfer.failed':
                $this->updateOrderStatus($data, 'Failed');
                return response()->json(['message' => 'Transfer failed processed'], 200);

            case 'transfer.reversed':
                $this->updateOrderStatus($data, 'Reversed');
                return response()->json(['message' => 'Transfer reversed processed'], 200);

            default:
                // For subscription, invoice, etc.
                return response()->json(['message' => 'Event logged: '.$event], 200);
        }
    }

    /**
     * Update order status helper
     */
    protected function updateOrderStatus(array $data, string $status)
    {
        $reference = $data['reference'] ?? null;
        $transId   = $data['id'] ?? null;

        if (!$reference) {
            Log::channel('paystack')->warning('Missing reference in webhook payload', $data);
            return;
        }

        DB::table('orders')
            ->where('tx_ref', $reference)
            ->update([
                'trans_id'   => $transId,
                'status'     => $status,
                'updated_at' => now(),
            ]);
    }



    public function index()
    {

        $totalOrders = Order::count();
        $Orders = Order::with('customer','vendor')->get();
        // $totalFoods = Food::count();


        return view('admin.orders.index', compact('Orders', 'totalOrders'));
    }


    public function show($id)
    {
        // dd( $id);
        $order =Order::find($id);
        $approved = Dispatcher::where('status', 'approved')->get();
        return view('admin.orders.order', compact('order', 'approved'));
    }

    public function assignDispatcher(Request $request)
    {
        $request->validate([
            'dispatcher_id' => 'required|exists:dispatchers,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        $dispatcher = Dispatcher::findOrFail($request->dispatcher_id);
        $order = Order::find($request->order_id);
        $user = User::findOrFail($order->user_id);
        $order->dispatcher_id = $request->dispatcher_id;

        $order->assigned_at = Carbon::now();
        
        $order->status = 'Rider Dispatched';
        $order->save();

        // Send email to the customer
        //if ($order->user && $order->user->email) {
            //Mail::to($order->user->email)->send(new DispatcherAssigned($order, $order->dispatcher_id));}

            // Send the verification email
            Mail::send('emails.dispatcher_assigned', ['user_name' => $user->fullname,
            'order_id'=>$order->id,
            'dispatcher_name'=> $dispatcher->full_name,
            'dispatcher_phone_number'=>$dispatcher->phone_number],
            function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Order Assigned To Disaptcher');
            });





        // return ApiResponse::success(null, 'Dispatcher details sent to user.');
        return redirect()->back()->with('success', 'Dispatcher assigned and eamil sent successfully!');
    }






}
