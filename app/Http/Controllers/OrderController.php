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
use App\Notifications\PushNotification;


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

        // Send push notification when order is saved
        $user = User::find($userId);

        if ($user) {
            if ($user->fcm_token) {
                $title = "📝 Order Saved!";
                $message = "Hi {$user->name}, your order has been created successfully. 🎉  
                Sit back and relax, YourErrandsGuy is on it! 🛵  
                — YourErrandsGuy! Errands done, Worry Gone 🚀";

                $user->notify(new PushNotification(
                    $title,
                    $message,
                    [
                        'order_id'  => $orderId,
                        'status'    => 'created',
                        'timestamp' => now()->toDateTimeString(),
                        'brand'     => 'YourErrandsGuy',
                    ]
                ));
            } else {
                \Log::warning("User {$user->id} has no FCM token. Notification not sent.");
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
        if (!$signature || $signature !== hash_hmac('sha512', $request->getContent(), env('PAYSTACK_SECRET_KEY'))) {
            Log::warning('Paystack webhook: Invalid signature', $request->all());
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 401);
        }

        $event = $request->input('event');
        $data  = $request->input('data');

        switch ($event) {
            case 'charge.success':
                $this->updateOrderStatus($data, 'Payment successful');
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
        if ($status === 'Payment successful') {
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


            // Send push notification on successful payment
            $user = User::find($order->user_id);

            if ($user) {
                if ($user->fcm_token) {
                    $title = "🎉 Payment Successful!";
                    $message = "Hi {$user->name}, your payment of ₦" . number_format($order->amount, 2) . " was successful. 🟢 
                    Your order is on its way! 🛵  
                    — YourErrandsGuy! Errands done, Worry Gone 🚀";

                    $user->notify(new PushNotification(
                        $title,
                        $message,
                        [
                            'order_id'  => $order->id,
                            'amount'    => $order->amount,
                            'status'    => 'success',
                            'timestamp' => now()->toDateTimeString(),
                            'brand'     => 'YourErrandsGuy',
                        ]
                    ));
                } else {
                    \Log::warning("User {$user->id} has no FCM token. Notification not sent.");
                }
            }


           if ($Order->vendor) {
                if ($Order->vendor->fcm_token) {
                    $title = "📦 New Order To Process!";
                    $message = "Hello {$Order->vendor->name}, you have a new order #{$Order->id} to process for {$Order->customer->full_name}.  
                    — YourErrandsGuy! Errands done, Worry Gone 🚀";

                    $Order->vendor->notify(new PushNotification(
                        $title,
                        $message,
                        [
                            'order_id'  => $Order->id,
                            'status'    => $Order->status,
                            'role'      => 'vendor',
                            'timestamp' => now()->toDateTimeString(),
                            'brand'     => 'YourErrandsGuy',
                        ]
                    ));
                } else {
                    \Log::warning("Vendor {$Order->vendor->id} has no FCM token. Notification not sent.");
                }
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
            'order_id'      => 'required|exists:orders,id',
        ]);

        $dispatcher = Dispatcher::findOrFail($request->dispatcher_id);
        $order      = Order::findOrFail($request->order_id);
        $user       = User::findOrFail($order->user_id);
        $vendor     = Vendor::find($order->vendor_id); // assuming order has vendor_id

        // Update order
        $order->dispatcher_id = $request->dispatcher_id;
        $order->assigned_at   = now();
        $order->status        = 'Rider Dispatched';
        $order->save();

        /**
         * Email notification to user
         */
        Mail::send(
            'emails.dispatcher_assigned',
            [
                'user_name'              => $user->fullname,
                'order_id'               => $order->id,
                'dispatcher_name'        => $dispatcher->full_name,
                'dispatcher_phone_number'=> $dispatcher->phone_number,
            ],
            function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Order Assigned To Dispatcher');
            }
        );

        /**
         * Push Notifications
         */

        // User Notification
        if ($user->fcm_token) {
            $user->notify(new PushNotification(
                "🚚 Dispatcher Assigned!",
                "Hi {$user->fullname}, your order #{$order->id} has been assigned to {$dispatcher->full_name}. They’ll contact you soon.  
                — YourErrandsGuy! Errands done, Worry Gone 🚀",
                [
                    'order_id'  => $order->id,
                    'status'    => $order->status,
                    'role'      => 'user',
                    'timestamp' => now()->toDateTimeString(),
                ]
            ));
        }

        // Dispatcher Notification
        if ($dispatcher->fcm_token) {
            $dispatcher->notify(new PushNotification(
                "📦 New Order Assigned!",
                "Hello {$dispatcher->full_name}, you’ve been assigned order #{$order->id}.  
                Please contact the customer at {$user->phone_number}.  
                — YourErrandsGuy! Errands done, Worry Gone 🚀",
                [
                    'order_id'  => $order->id,
                    'status'    => $order->status,
                    'role'      => 'dispatcher',
                    'timestamp' => now()->toDateTimeString(),
                ]
            ));
        }

        // Vendor Notification
        if ($vendor && $vendor->fcm_token) {
            $vendor->notify(new PushNotification(
                "✅ Order Dispatched!",
                "Order #{$order->id} has been dispatched with {$dispatcher->full_name}.  
                — YourErrandsGuy! Errands done, Worry Gone 🚀",
                [
                    'order_id'  => $order->id,
                    'status'    => $order->status,
                    'role'      => 'vendor',
                    'timestamp' => now()->toDateTimeString(),
                ]
            ));
        }

        return redirect()->back()->with('success', 'Dispatcher assigned, email and notifications sent successfully!');
    }




}
