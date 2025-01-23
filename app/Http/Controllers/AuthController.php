<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Custom\ApiResponse;

class AuthController extends Controller
{
    // Registration method
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
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

        return ApiResponse::success([
            'token' => $token,
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

        return ApiResponse::success([
            'token' => $token,
        ], 'Login successful.');
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

}
