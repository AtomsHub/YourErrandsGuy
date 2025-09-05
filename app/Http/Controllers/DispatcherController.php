<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Custom\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            return ApiResponse::failed('Invalid credentials.', null, 401);
        }

      

        if (!$user->status != "approved") {
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



    // public function orders(Request $request)
    // {
    //     $user = $request->user();
    //     $vendor = Order::with(['customer','vendor','dispatcher','cartItems'])->where('id', $user->id)->first();


    //       return ApiResponse::success([
    //         'user' => [
    //             'id' => $user->id,
    //             'full_name' => $user->full_name,
    //             'phone_number' => $user->phone_number,
    //             'email' => $user->email,
    //             'home_address' => $user->home_address,
    //             'date_of_birth' => $user->date_of_birth,
    //             'national_id_number' => $user->national_id_number,
    //             'driver_license_number' => $user->driver_license_number,
    //             'id_document_path' => $user->id_document_path,
    //             'motorbike_license_plate_number' => $user->motorbike_license_plate_number,
    //             'bank_account_name' => $user->bank_account_name,
    //             'bank_account_number' => $user->bank_account_number,
    //             'bank_name' => $user->bank_name,
    //              'walletBalance' => $user->walletBalance,
    //         ]
    //     ], 'Login successfully.');
    // }

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

        return response()->json(['message' => 'Dispatcher approved.']);
    }

    public function disapprove($id)
    {
        $dispatcher = Dispatcher::findOrFail($id);
        $dispatcher->status = 'disapproved';
        $dispatcher->save();

        return response()->json(['message' => 'Dispatcher disapproved.']);
    }

    public function show()
    {
        $approved = Dispatcher::where('status', 'approved')->get();
        $unapproved = Dispatcher::where('status', 'unapproved')->get();
        $disapproved = Dispatcher::where('status', 'disapproved')->get();

        return view('admin.dispatchers', compact('approved', 'unapproved', 'disapproved'));
    }


    // OrderController.php
    public function completeByTransactionId(Request $request)
    {
        
        $request->validate([
            'trans_id' => 'required|string|exists:orders,trans_id',
        ]);

        $user = auth()->user();
        $order = Order::where('trans_id', $request->transaction_id)->first();

        // Ensure the user is either the owner or the assigned dispatcher
      
        $isDispatcher = $order->dispatcher_id === $user->id;

        if ( ! $isDispatcher) {
            return response()->json(['message' => 'Unauthorized. You are not assigned to this order.'], 403);
        }

        if ($order->status === 'completed') {
            return response()->json(['message' => 'Order already completed'], 400);
        }

        // Proceed with completion
        $order->status = 'completed';
        $order->completed_at = now();
        $order->save();

        // Credit dispatcher's wallet with service charge
        $dispatcher = Dispatcher::where('id', $user->id)->first();

        if (! $dispatcher) {
            return response()->json(['message' => 'Dispatcher profile not found'], 404);
        }

        $serviceCharge = $order->delivery_fee ?? 0; // Make sure this field exists

        $dispatcher->walletBalance += $serviceCharge;
        $dispatcher->save();

        // Transaction::create([
        //     'user_id'       => $user->id,
        //     'dispatcher_id' => $dispatcher->id,
        //     'order_id'      => $order->id,
        //     'status'        => 'credit',
        //     'amount'        => $serviceCharge,
        // ]);
    
        // return response()->json([
        //     'message'            => 'Order marked as completed',
        //     'completed_at'       => $order->completed_at,
        //     'credited_amount'    => $serviceCharge,
        //     'new_wallet_balance' => $dispatcher->walletBalance,
        // ]);

        return response()->json([
            'message' => 'Order marked as completed',
            'completed_at' => $order->completed_at,
        ]);
    }
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


}
