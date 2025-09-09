<?php

namespace App\Http\Controllers;
use App\Custom\ApiResponse;
use App\Models\Dispatcher;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //

    public function getProtectionFee(Request $request)
    {
      

        $validator = Validator::make($request->all(), [
             'amount' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        $amount = $request->input('amount');
        $protectionFee = $amount * 0.2; // 50% of amount

        return ApiResponse::success([
            'amount' => $amount,
            'protection_fee' => $protectionFee
        ], 'Protection fee calculated successfully');
    }

    public function saveOrders(Request $request)
    {
        $userId = auth()->id();
        $cartItems = $request->input('cartItems');
        $transaction_id = $request->input('transaction_id');
        // $amount_worth = $request->input('amount_worth') ?? 0.00 ;
        // $protection_fee = $request->input('protection_fee') ?? 0.00 ;

        $packageWorth   = $data['formDetails']['packageWorth'] ?? ($data['items'][0]['packageWorth'] ?? 0);
        $amount_worth    = $packageWorth;
        $protection_fee  = $data['itemAmount'] ?? 0;

        foreach ($cartItems as $cartItem) {
            $vendorId = null;
            $deliveryLandmark = null;
            $pickupLandmark = null;

            if ($cartItem['services'] === 'Restaurant') {
                $vendorId = $cartItem['restaurant_id'] ?? null;
                $deliveryLandmark = isset($cartItem['deliveryFee']['landmark']) ? $cartItem['deliveryFee']['landmark'] : null;
            } elseif ($cartItem['services'] === 'Laundry') {
                $vendorId = $cartItem['laundry_id'] ?? null;
                $deliveryLandmark = isset($cartItem['deliveryFee']['landmark']) ? $cartItem['deliveryFee']['landmark'] : null;
            } elseif ($cartItem['services'] === 'Package') {
                $deliveryLandmark = $cartItem['formDetails']['selectedDropOffArea']['title'] ?? null;
                $pickupLandmark   = $cartItem['formDetails']['selectedErrandArea']['title'] ?? null;
            }

            // ✅ Check if order with this transaction_id already exists
            $existingOrder = DB::table('orders')->where('trans_id', $transaction_id)->first();

            if ($existingOrder) {
                // Update existing order
                DB::table('orders')
                    ->where('id', $existingOrder->id)
                    ->update([
                        'user_id'           => $userId,
                        'vendor_id'         => $vendorId,
                        'service_type'      => $cartItem['services'],
                        'item_amount'       => $cartItem['itemAmount'],
                        'amount_worth'       => $amount_worth,
                        'protection_fee'       => $protection_fee,
                        'delivery_fee'      => is_array($cartItem['deliveryFee']) ? $cartItem['deliveryFee']['price'] : $cartItem['deliveryFee'],
                        'delivery_landmark' => $deliveryLandmark,
                        'pickup_landmark'   => $pickupLandmark,
                        'total_amount'      => $cartItem['totalAmount'],
                        'form_details'      => json_encode($cartItem['formDetails']),
                        'items'             => json_encode($cartItem['items']),
                        'status'            => 'Make Payment',
                        'updated_at'        => Carbon::now(),
                    ]);

                $orderId = $existingOrder->id;

                // Remove old cart_items and reinsert
                DB::table('cart_items')->where('order_id', $orderId)->delete();

            } else {
                // Create new order
                $orderId = DB::table('orders')->insertGetId([
                    'user_id'           => $userId,
                    'vendor_id'         => $vendorId,
                    'service_type'      => $cartItem['services'],
                    'item_amount'       => $cartItem['itemAmount'],
                    'amount_worth'       => $amount_worth,
                    'protection_fee'       => $protection_fee,
                    'delivery_fee'      => is_array($cartItem['deliveryFee']) ? $cartItem['deliveryFee']['price'] : $cartItem['deliveryFee'],
                    'delivery_landmark' => $deliveryLandmark,
                    'pickup_landmark'   => $pickupLandmark,
                    'total_amount'      => $cartItem['totalAmount'],
                    'trans_id'          => $transaction_id,
                    'form_details'      => json_encode($cartItem['formDetails']),
                    'items'             => json_encode($cartItem['items']),
                    'status'            => 'Make Payment',
                    'created_at'        => Carbon::now(),
                ]);
            }

            // Insert cart_items (fresh data)
            foreach ($cartItem['items'] as $item) {
                if (is_array($item)) {
                    DB::table('cart_items')->insert([
                        'order_id'     => $orderId,
                        'items_id'     => $item['item_id'] ?? null,
                        'description'  => $item['description'] ?? $item['name'] ?? null,
                        'quantity'     => $item['quantity'] ?? 1,
                        'rate'         => $item['rate'] ?? $item['price'] ?? null,
                        'pricePerItem' => $item['pricePerItem'] ?? 0.00,
                        'serviceName'  => $item['serviceName'] ?? null,
                    ]);
                } else {
                    DB::table('cart_items')->insert([
                        'order_id'     => $orderId,
                        'items_id'     => null,
                        'description'  => $item,
                        'quantity'     => 1,
                        'rate'         => null,
                        'pricePerItem' => 0.00,
                        'serviceName'  => 'Package',
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Orders saved successfully!']);
    }




    public function getUserOrders(Request $request)
    {
        $user = auth()->user();
        

        // Fetch orders with restaurant name when restaurant_id is present
        $orders = $user->orders()->select('id', 'service_type', 'amount_worth','protection_fee','item_amount', 'delivery_fee','delivery_landmark','pickup_landmark', 'total_amount', 'status', 'vendor_id', 'created_at')
            ->with(['vendor:id,name', 'cartItems'])  // Load the vendor's name
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



    public function handleWebhook(Request $request)
    {
        Log::info('Paystack webhook received', $request->all());

        // 🔐 Verify Paystack signature
        $signature = $request->header('x-paystack-signature');
        if (!$signature || $signature !== hash_hmac('sha512', $request->getContent(), config('services.paystack.secret'))) {
            Log::warning('Paystack webhook: Invalid signature', $request->all());
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 401);
        }

        $event = $request->input('event');
        $data  = $request->input('data');

        switch ($event) {
            case 'charge.success':
                $this->updateOrderStatus($data, 'Processing');
                break;

            case 'transfer.success':
                $this->updateOrderStatus($data, 'Transfer Successful');
                break;

            case 'transfer.failed':
                $this->updateOrderStatus($data, 'Transfer Failed');
                break;

            default:
                Log::info("Paystack webhook: Unhandled event {$event}", $data ?? []);
                break;
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function updateOrderStatus(array $data, string $status)
    {
        // 🔑 Your own transaction ID from metadata
        $localTransId = $data['metadata']['trans_id'] ?? null;

        // Paystack transaction ID
        $paystackId   = $data['reference'] ?? null;

        if (!$localTransId) {
            Log::warning('Paystack webhook: Missing trans_id in metadata', $data);
            return;
        }

        // ✅ Update the order using your local trans_id
        $updated = DB::table('orders')
            ->where('trans_id', $localTransId)
            ->update([
                'tx_ref' => $paystackId, // store Paystack’s own id separately
                'status'      => $status,
                'updated_at'  => now(),
            ]);

        if (!$updated) {
            Log::warning("Paystack webhook: Order with trans_id {$localTransId} not found", $data);
            return;
        }

        // 💰 If it's a successful charge, update vendor balance
        if ($status === 'Processing') {
            $order = DB::table('orders')
                ->where('trans_id', $localTransId)
                ->first();

            if ($order) {
                $itemAmount = $order->item_amount; // adjust column name if different

                DB::table('vendors')
                    ->where('id', $order->vendor_id)
                    ->increment('balance', $itemAmount);

                Log::info("Paystack webhook: Vendor {$order->vendor_id} balance incremented by {$itemAmount}");
            }
        }

        Log::info("Paystack webhook: Order {$localTransId} updated to {$status}");
    }



    /**
     * Update order status helper
     */

  




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




    public function paystackCallback(Request $request)
    {
        $reference = $request->query('reference');
        if (!$reference) {
            return ApiResponse::notFound('Transaction reference missing.');
        }

        // Verify transaction with Paystack
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        if (!$response->successful()) {
            return ApiResponse::notFound('Unable to verify transaction.');
        }

        $data = $response->json('data');
        if (!$data) {
            return ApiResponse::notFound('No transaction data found.');
        }

        $status = $data['status']; // success | failed | abandoned
        $mappedStatus = $status === 'success' ? 'Processing' : 'Failed';

        // Reuse same method as webhook
        $this->callbackupdateOrderStatus($data, $mappedStatus);

        if ($mappedStatus === 'Processing') {
            return ApiResponse::success(null, 'Order placed successfully!');
        }

        return ApiResponse::notFound('Transaction failed or order not found.');
    }

    protected function callbackupdateOrderStatus(array $data, string $status)
    {
        $reference = $data['reference'] ?? null;
        $transId   = $data['id'] ?? null;

        if (!$reference) {
            Log::channel('paystack')->warning('Missing reference in callback payload', $data);
            return;
        }

        // Update the order status
        $order = DB::table('orders')
            ->where('tx_ref', $reference)
            ->update([
                'trans_id'   => $transId,
                'status'     => $status,
                'updated_at' => now(),
            ]);

        // If successful, update vendor balance
        if ($status === 'Processing') {
            $order = DB::table('orders')
                ->where('tx_ref', $reference)
                ->first();

            if ($order) {
                $itemAmount = $order->final_amount;

                DB::table('vendors')
                    ->where('id', $order->vendor_id)
                    ->increment('balance', $itemAmount);
            }
        }
    }






}
