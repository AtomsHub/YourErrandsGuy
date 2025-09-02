<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
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

        $user = User::where('email', $request->email)->where('verification_code', $request->verification_code)->first();

        if (!$user) {
            return ApiResponse::failed('Invalid verification code or email.', null, 400);
        }

        $user->email_verified = true;
        $user->verification_code = null; // Clear the code
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        $popular = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('tag','popular')->get();
        $vendors = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('service_type','Restaurant')->get();
        $laundries = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('service_type','Laundry')->get();

        return ApiResponse::success([
            'token' => $token,
             'user' => [
                'id' => $user->id,
                'fullname' => $user->fullname,
                'address' => $user->address,
                'email' => $user->email,
                'phone' => $user->phone,
                'dob' => $user->dob,
            ],
            'popular' => $popular->map(function ($popular) {
                return [
                    'id' => $popular->id,
                    'name' => $popular->name,
                    'description' => $popular->description,
                    'image' => $popular->image,
                    'tag' => $popular->tag,
                    'items' => $popular->items, // Include items if necessary
                ];
            }),
            'vendors' => $vendors->map(function ($vendor) {
                return [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'description' => $vendor->description,
                    'image' => $vendor->image,
                    'tag' => $vendor->tag,
                    'items' => $vendor->items, // Include items if necessary
                ];
            }),
            'laundries' => $laundries->map(function ($laundry) {
                return [
                    'id' => $laundry->id,
                    'name' => $laundry->name,
                    'address' => $laundry->address,
                    'description' => $laundry->description,
                    'image' => $laundry->image,
                    'tag' => $laundry->tag,
                    'items' => $laundry->items, // Include items if necessary
                ];
            }),
        ], 'Email verified successfully.');
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

        $popular = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('tag','popular')->get();
        $vendors = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('service_type','Restaurant')->get();
        $laundries = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('service_type','Laundry')->get();
        
        $popular->each(function ($vendor) {
            $vendor->vitems->each->makeHidden(['wash', 'starch', 'iron']);
        });
        
        $vendors->each(function ($vendor) {
            $vendor->vitems->each->makeHidden(['wash', 'starch', 'iron']);
        });


        return ApiResponse::success([
            'token' => $token,
             'user' => [
                'id' => $user->id,
                'fullname' => $user->fullname,
                
                'email' => $user->email,
                'phone' => $user->phone,
                'dob' => $user->dob,
            ],
            'popular' => $popular->map(function ($popular) {
                return [
                    'id' => $popular->id,
                    'name' => $popular->name,
                    'address' => $popular->address,
                    'description' => $popular->description,
                    'image' => $popular->item->image ?? null,
                    'tag' => $popular->tag,
                     'deliveryfee' => $popular->deliveryfee,
                    'items' => $popular->items, // Include items if necessary
                ];
            }),
            'vendors' => $vendors->map(function ($vendor) {
                return [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'address' => $vendor->address,
                    'description' => $vendor->description,
                    'image' => $vendor->item->image ?? null,
                    'tag' => $vendor->tag,
                    'deliveryfee' => $vendor->deliveryfee,
                    'items' => $vendor->items, // Include items if necessary
                ];
            }),
            'laundries' => $laundries->map(function ($laundry) {
                return [
                    'id' => $laundry->id,
                    'name' => $laundry->name,
                    'address' => $laundry->address,
                    'description' => $laundry->description,
                    'image' => $laundry->image, // Ensure correct image path
                    'tag' => $laundry->tag,
                    'deliveryfee' => $laundry->deliveryfee, // Convert to float
                    'items' => $laundry->vitems->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'price' => [
                                'wash' => (float) $item->wash,  // Convert wash to float
                                'iron' => (float) $item->iron,  // Convert iron to float
                                'starch' => (float) $item->starch,  // Convert starch to float
                            ],
                            'image' => $item->item->image ?? null,
                            'created_at' => $item->created_at,
                            'updated_at' => $item->updated_at,
                        ];
                    })
                ];
           }),
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
