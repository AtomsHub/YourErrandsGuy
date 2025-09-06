<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
use App\Helpers\VendorTransformer;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Registration method
    public function register(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'dob' => 'required|date',
        ]);


        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        $verificationCode = rand(100000, 999999); // Generate 6-digit code
        
        $user = User::create([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'verification_code' => $verificationCode,
            'email_verified' => false,
        ]);

        // Send verification email
        Mail::send('emails.verification', ['code' => $verificationCode], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verify Your Email');
        });

        return ApiResponse::success(null, 'Registration successful. A verification code has been sent to your email.');
    }

    // Verify Email method
   public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->verification_code)
            ->first();

        if (!$user) {
            return ApiResponse::failed('Invalid verification code or email.', null, 400);
        }

        $user->email_verified = true;
        $user->verification_code = null; // Clear the code
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        // Eager load vendors
        $popular   = Vendor::with(['vendorItems.item', 'deliveryfee', 'vitems.item'])
                        ->where('tag', 'popular')->get();
        $vendors   = Vendor::with(['vendorItems.item', 'deliveryfee', 'vitems.item'])
                        ->where('service_type', 'Restaurant')->get();
        $laundries = Vendor::with(['vendorItems.item', 'deliveryfee', 'vitems.item'])
                        ->where('service_type', 'Laundry')->get();


        $userOrders = Order::selectRaw('COUNT(*) as totalOrderCount, COALESCE(SUM(total_amount), 0) as totalAmountSpent')->where('user_id', $user->id)->first();



        

        return ApiResponse::success([
            'token' => $token ?? null,
            'user' => [
                'id'       => $user->id,
                'fullname' => $user->fullname,
                'email'    => $user->email,
                'phone'    => $user->phone,
                'dob'      => $user->dob,
                'address'  => $user->address ?? null,
                'totalOrderCount' => $userOrders->totalOrderCount ?? 0,
               'totalAmountSpent' => $userOrders->totalAmountSpent ?? 0.00,
            ],
            'popular'   => VendorTransformer::transformPopular($popular),
            'vendors'   => VendorTransformer::transformVendors($vendors),
            'laundries' => VendorTransformer::transformLaundries($laundries),
        ], 'Email verified successfully!');


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

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiResponse::failed('Invalid credentials.', null, 401);
        }

        if (!$user->email_verified) {
            return ApiResponse::failed('Email not verified. Please verify your email to continue.', null, 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Eager load everything needed
        $popular   = Vendor::with(['vendorItems.item', 'deliveryfee', 'vitems.item'])->where('tag', 'popular')->get();
        $vendors   = Vendor::with(['vendorItems.item', 'deliveryfee', 'vitems.item'])->where('service_type', 'Restaurant')->get();
        $laundries = Vendor::with(['vendorItems.item', 'deliveryfee', 'vitems.item'])->where('service_type', 'Laundry')->get();

        $userOrders = Order::selectRaw('COUNT(*) as totalOrderCount, COALESCE(SUM(total_amount), 0) as totalAmountSpent')->where('user_id', $user->id)->first();


       
        return ApiResponse::success([
            'token' => $token ?? null,
            'user' => [
                'id'       => $user->id,
                'fullname' => $user->fullname,
                'email'    => $user->email,
                'phone'    => $user->phone,
                'dob'      => $user->dob,
                'address'  => $user->address ?? null,
                'totalOrderCount' => $userOrders->totalOrderCount ?? 0,
               'totalAmountSpent' => $userOrders->totalAmountSpent ?? 0.00,
            ],
            'popular'   => VendorTransformer::transformPopular($popular),
            'vendors'   => VendorTransformer::transformVendors($vendors),
            'laundries' => VendorTransformer::transformLaundries($laundries),
        ], 'Login successfully.');
    }


    public function resendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return ApiResponse::failed('Validation errors', $validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return ApiResponse::failed('Email not found.', null, 404);
        }

        if ($user->email_verified) {
            return ApiResponse::failed('Email is already verified.', null, 400);
        }

        $verificationCode = rand(100000, 999999); // Generate a new 6-digit code

        $user->verification_code = $verificationCode;
        $user->save();

        // Send the verification email
        Mail::send('emails.verification', ['code' => $verificationCode], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Resend: Verify Your Email');
        });

        return ApiResponse::success(null, 'A new verification code has been sent to your email.');
    }
    
    public function forgotPassword(Request $request)
    {
        // Validate email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return ApiResponse::failed('Email not found.', null, 404);
        }

        // Generate a new 6-digit password reset code
        $resetCode = rand(100000, 999999);

        // Save the reset code to the user record
        $user->password_reset_code = $resetCode;
        $user->save();

        // Send the password reset email
        Mail::send('emails.password_reset', ['code' => $resetCode], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Your Password');
        });

        return ApiResponse::success(null, 'A password reset code has been sent to your email.');
    }
    
    public function verifyResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'reset_code' => 'required|string|min:6|max:6'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'status_code' => 422
            ], 422);
        }
    
        $user = User::where('email', $request->email)->first();
        
        // dd($user->password_reset_code);
    
        if (!$user || $user->password_reset_code !== $request->reset_code) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid reset code or email.',
                'status_code' => 400
            ], 400);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Reset code verified. You can now reset your password.'
        ]);
    }


    public function changePassword(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password_reset_code' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationFailed($validator->errors());
        }

        // Retrieve the user by email and reset code
        $user = User::where('email', $request->email)
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
