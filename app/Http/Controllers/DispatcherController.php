<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
use App\Models\Dispatcher;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PushNotification;
use Illuminate\Support\Str;

class DispatcherController extends Controller
{
    public function index()
    {
        return view ('admin.dispatchers');
    }

    
    // Login method
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        $user = Dispatcher::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiResponse::failed('Invalid credentials.', null, 402);
        }

      

        if ($user->status !== "approved") {
            return ApiResponse::failed('Dispatcher is yet to be verified.', null, 403);
        }

        $token = $user->createToken('dispatch_auth_token')->plainTextToken;

      


        return ApiResponse::success([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'home_address' => $user->home_address,
                'date_of_birth' => $user->date_of_birth,
                'national_id_number' => $user->national_id_number,
                'driver_license_number' => $user->driver_license_number,
                'id_document_path' => $user->id_document_path,
                'motorbike_license_plate_number' => $user->motorbike_license_plate_number,
                'bank_account_name' => $user->bank_account_name,
                'bank_account_number' => $user->bank_account_number,
                'bank_name' => $user->bank_name,
                 'walletBalance' => $user->walletBalance,
            ]
        ], 'Login successfully.');
    }


    public function dashboard(Request $request)
    {
        $user = $request->user();
        $vendor = Dispatcher::where('id', $user->id)->first();


          return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'home_address' => $user->home_address,
                'date_of_birth' => $user->date_of_birth,
                'national_id_number' => $user->national_id_number,
                'driver_license_number' => $user->driver_license_number,
                'id_document_path' => $user->id_document_path,
                'motorbike_license_plate_number' => $user->motorbike_license_plate_number,
                'bank_account_name' => $user->bank_account_name,
                'bank_account_number' => $user->bank_account_number,
                'bank_name' => $user->bank_name,
                 'walletBalance' => $user->walletBalance,
            ]
        ], 'Login successfully.');
    }

    public function orders(Request $request)
    {
        $user = $request->user();

        // Fetch all orders for the authenticated user
        $orders = Order::with(['vendor', 'dispatcher', 'cartItems','customer'])
            ->where('dispatch_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return ApiResponse::success([
            'orders' => $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'service_type' => $order->service_type,
                    'item_amount' => $order->item_amount,
                    'delivery_fee' => $order->delivery_fee,
                    'delivery_landmark' => $order->delivery_landmark,
                    'total_amount' => $order->total_amount,
                    'transaction_id' => $order->trans_id,
                    'form_details' => json_decode($order->form_details, true),
                    'items' => json_decode($order->items, true),
                    'status' => $order->status,
                    'created_at' => $order->created_at->toDateTimeString(),

                    // Vendor details
                    'vendor' => $order->vendor ? [
                        'id' => $order->vendor->id,
                        'name' => $order->vendor->name,
                        'address' => $order->vendor->address,
                        'service_type' => $order->vendor->service_type,
                    ] : null,

                    // Dispatcher details
                    'dispatcher' => $order->dispatcher ? [
                        'id' => $order->dispatcher->id,
                        'full_name' => $order->dispatcher->full_name,
                        'phone_number' => $order->dispatcher->phone_number,
                    ] : null,

                    // Cart items details
                    'cart_items' => $order->cartItems->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'items_id' => $item->items_id,
                            'description' => $item->description,
                            'quantity' => $item->quantity,
                            'rate' => $item->rate,
                            'price_per_item' => $item->pricePerItem,
                            'service_name' => $item->serviceName,
                        ];
                    }),
                ];
            })
        ], 'Orders fetched successfully.');
    }


    public function store(Request $request)
    {


        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:dispatchers,email',
            'home_address' => 'required|string',
            'date_of_birth' => 'required|date',
            'national_id_number' => 'required|string|unique:dispatchers,national_id_number',
            'driver_license_number' => 'required|string|unique:dispatchers,driver_license_number',
            'motorbike_license_plate_number' => 'required|string',
            'bank_account_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_name' => 'required|string',
            'license_expiration_date' => 'required|date',

        ]);



                $idDocumentPath = null;

                if (isset($request['id_document'])) {

                if ($request->hasFile('id_document')) {
                $docs = $request->file('id_document');
                $filename = $docs->getClientOriginalName();
                $destinationPath = public_path('documents');

                // Move image to public folder
                $docs->move($destinationPath, $filename);

                // Save correct public path in DB
                $idDocumentPath = 'documents/' . $filename;
                }
                }

                $hackneyPermitPath = null;

                if (isset($request['hackney_permit'])) {

                if ($request->hasFile('hackney_permit')) {
                $docus = $request->file('hackney_permit');
                $hackneyname = $docus->getClientOriginalName();
                $hackneyPath = public_path('documents');

                // Move image to public folder
                $docus->move($hackneyPath, $hackneyname);

                // Save correct public path in DB
                $hackneyPermitPath = 'documents/' . $hackneyname;
                }
                }


                $password = Str::random(6); // generates a 10-character password
                $hashedPassword = Hash::make($password);



        Dispatcher::create([
            'full_name' => $validated['full_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'home_address' => $validated['home_address'],
            'date_of_birth' => $validated['date_of_birth'],
            'national_id_number' => $validated['national_id_number'],
            'driver_license_number' => $validated['driver_license_number'],
            'id_document_path' => $idDocumentPath,
            'motorbike_license_plate_number' => $validated['motorbike_license_plate_number'],
            'bank_account_name' => $validated['bank_account_name'],
            'bank_account_number' => $validated['bank_account_number'],
            'bank_name' => $validated['bank_name'],
            'license_expiration_date' => $validated['license_expiration_date'],
            'hackney_permit' => $hackneyPermitPath,
            'status' => 'unapproved', // Default to active
            'password' => $hashedPassword,
        ]);

          Mail::send('emails.dispatcher', ['password' =>$password, 'full_name'=> $validated['full_name']],
         function ($message) use ($validated) {
            $message->to($validated['email']);
            $message->subject('Password Auto Generated');
        });

        return redirect()->route('admin.dispatchers.store')->with('success', 'Dispatcher registered successfully.');
    }



    public function approve($id)
    {
        $dispatcher = Dispatcher::findOrFail($id);
        $dispatcher->status = 'approved';
        $dispatcher->save();

        /**
         * Email notification
         */
        if ($dispatcher->email) {
            Mail::send('emails.dispatcher_approved', [
                'dispatcher_name' => $dispatcher->full_name,
            ], function ($message) use ($dispatcher) {
                $message->to($dispatcher->email);
                $message->subject('🎉 Dispatcher Approved');
            });
        }

        /**
         * Push notification
         */
        if ($dispatcher->fcm_token) {
            $dispatcher->notify(new PushNotification(
                "✅ Approval Successful!",
                "Hi {$dispatcher->full_name}, your account has been approved. You can now start handling deliveries.  
                — YourErrandsGuy! Errands done, Worry Gone 🚀",
                [
                    'dispatcher_id' => $dispatcher->id,
                    'status'        => $dispatcher->status,
                    'role'          => 'dispatcher',
                    'timestamp'     => now()->toDateTimeString(),
                ]
            ));
        }

        return response()->json(['success' => true, 'message' => 'Dispatcher approved and notified.']);
    }


    public function disapprove($id)
    {
        $dispatcher = Dispatcher::findOrFail($id);
        $dispatcher->status = 'disapproved';
        $dispatcher->save();

        /**
         * Email notification
         */
        // if ($dispatcher->email) {
        //     Mail::send('emails.dispatcher_disapproved', [
        //         'dispatcher_name' => $dispatcher->full_name,
        //     ], function ($message) use ($dispatcher) {
        //         $message->to($dispatcher->email);
        //         $message->subject('⚠️ Dispatcher Disapproved');
        //     });
        // }

        /**
         * Push notification
         */
        if ($dispatcher->fcm_token) {
            $dispatcher->notify(new PushNotification(
                "⚠️ Approval Declined",
                "Hi {$dispatcher->full_name}, unfortunately your account has been disapproved. Please contact support for more details.  
                — YourErrandsGuy! Errands done, Worry Gone 🚀",
                [
                    'dispatcher_id' => $dispatcher->id,
                    'status'        => $dispatcher->status,
                    'role'          => 'dispatcher',
                    'timestamp'     => now()->toDateTimeString(),
                ]
            ));
        }

        return response()->json(['success' => true, 'message' => 'Dispatcher disapproved and notified.']);
    }


    public function show()
    {
        $approved = Dispatcher::where('status', 'approved')->get();
        $unapproved = Dispatcher::where('status', 'unapproved')->get();
        $disapproved = Dispatcher::where('status', 'disapproved')->get();

        return view('admin.dispatchers', compact('approved', 'unapproved', 'disapproved'));
    }


    // OrderController.php
    
    public function changePassword(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
          
            'password_reset_code' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        // Retrieve the user by email and reset code
        $user = Dispatcher::where('email', $request->email)
            ->where('password_reset_code', $request->password_reset_code)
            ->first();

        if (!$user) {
            return ApiResponse::failed('Invalid reset code or email.', null, 400);
        }

        // Update the user's password and clear the reset code
        $user->password = Hash::make($request->password);
        $user->password_reset_code = null;
        $user->save();

        return ApiResponse::success(null, 'Password changed successfully.');
    }


    public function sendMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100'
        ]);

         $users = auth()->user();
         $user = Dispatcher::where('id', $users->id)->first();

        $amount = $request->amount;
        $accountNumber = $user->account_number;
        $bankCode = $user->bank_code;
        $accountName = $user->bank_account_number;

        // ✅ Check balance
        if ($user->walletBalance < $amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        DB::beginTransaction();
        try {
            // ✅ Step 1: Verify account
            $verificationResponse = Http::withToken(env('PAYSTACK_SECRET_KEY'))
                ->get('https://api.paystack.co/bank/resolve', [
                    'account_number' => $accountNumber,
                    'bank_code' => $bankCode,
                ]);

            if (!$verificationResponse->successful() || !isset($verificationResponse['data'])) {
                return response()->json(['error' => 'Bank account verification failed'], 400);
            }

            $verifiedAccountName = $verificationResponse['data']['account_name'];

            // ✅ Step 2: Create transfer recipient
            $recipientResponse = Http::withToken(env('PAYSTACK_SECRET_KEY'))
                ->post('https://api.paystack.co/transferrecipient', [
                    'type' => 'nuban',
                    'name' => $accountName ?: $verifiedAccountName, 
                    'account_number' => $accountNumber,
                    'bank_code' => $bankCode,
                    'currency' => 'NGN',
                ]);

            if (!$recipientResponse->successful() || !isset($recipientResponse['data'])) {
                return response()->json(['error' => 'Failed to create transfer recipient'], 400);
            }

            $recipientCode = $recipientResponse['data']['recipient_code'];

            // ✅ Step 3: Initiate the transfer
            $transferResponse = Http::withToken(env('PAYSTACK_SECRET_KEY'))
                ->post('https://api.paystack.co/transfer', [
                    'source' => 'balance',
                    'reason' => 'Wallet Withdrawal',
                    'amount' => $amount * 100, // Convert NGN to Kobo
                    'recipient' => $recipientCode,
                ]);

            if (!$transferResponse->successful() || !isset($transferResponse['data'])) {
                DB::rollBack();
                return response()->json(['error' => 'Transfer failed'], 400);
            }

            // ✅ Deduct balance locally only after successful transfer
            $user->walletBalance -= $amount;
            $user->save();

            DB::commit();

            return response()->json([
                'message' => 'Transfer successful',
                'data' => $transferResponse['data'],
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function completeByTransactionId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trans_id' => 'required|string|exists:orders,trans_id'
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        $user  = auth()->user();
        $order = Order::where('trans_id', $request->trans_id)->first();

        // Ensure the user is the assigned dispatcher

        // dd($order->dispatch_id.'-'. $user->id);
        $isDispatcher = $order->dispatch_id === $user->id;

        if (! $isDispatcher) {
            return ApiResponse::failed('Unauthorized. You are not assigned to this order.', null, 403);
        }

        // Check order status before completion
        if ($order->status === 'Completed') {
            return ApiResponse::failed('Order already completed.', null, 400);
        }

        if ($order->status !== 'Rider Dispatched') {
            return ApiResponse::failed("Order cannot be completed. Current status: {$order->status}", null, 400);
        }

        // ✅ Proceed with completion
        $order->status       = 'Completed';
        $order->completed_at = now();
        $order->save();

        // Get dispatcher profile
        $dispatcher = Dispatcher::where('id', $user->id)->first();

        if (! $dispatcher) {
            return ApiResponse::failed('Dispatcher profile not found.', null, 404);
        }

        $serviceCharge = $order->delivery_fee ?? 0;

        $dispatcher->walletBalance += $serviceCharge;
        $dispatcher->save();

        // ✅ Push Notification for Dispatcher
        if ($dispatcher->fcm_token) {
            $title   = "✅ Order Completed!";
            $message = "Great job {$dispatcher->name}, you’ve successfully completed order #{$order->id}.  
            You earned ₦" . number_format($serviceCharge, 2) . " as your service charge. 💰  
            — YourErrandsGuy! Errands done, Worry Gone 🚀";

            $dispatcher->notify(new PushNotification(
                $title,
                $message,
                [
                    'order_id'   => $order->id,
                    'status'     => $order->status,
                    'role'       => 'dispatcher',
                    'earnings'   => $serviceCharge,
                    'timestamp'  => now()->toDateTimeString(),
                    'brand'      => 'YourErrandsGuy',
                ]
            ));
        } else {
            \Log::warning("Dispatcher {$dispatcher->id} has no FCM token. Notification not sent.");
        }

        return ApiResponse::success('Order marked as completed.', [
            'completed_at' => $order->completed_at,
            'earnings'     => $serviceCharge,
        ]);
    }


    public function saveFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $dispatcher = auth()->user();
        if (!$dispatcher) {
            return ApiResponse::failed('Dispatcher profile not found.', null, 404);
        }

        $dispatcher->fcm_token = $request->fcm_token;
        $dispatcher->save();

        return ApiResponse::success('Dispatcher FCM token saved successfully.', $dispatcher, 200);
    }









}
