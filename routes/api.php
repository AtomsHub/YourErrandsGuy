<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('verify-email', [AuthController::class, 'verifyEmail']);
Route::post('login', [AuthController::class, 'login']);
Route::post('resend', [AuthController::class, 'resendEmail']);

// Forgot Password routes
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('verify-reset-code', [AuthController::class, 'verifyResetCode']);
Route::post('reset-password', [AuthController::class, 'changePassword']);


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::post('orders/save', [OrderController::class, 'saveOrders']);
    Route::get('/orders', [OrderController::class, 'getUserOrders']);
    Route::post('updateOrder', [OrderController::class, 'updateOrder']);
    Route::get('/pickup-locations', [DeliveryController::class, 'getPickupLocations']);
    Route::get('/dropoff-locations/{pickup}', [DeliveryController::class, 'getDropoffLocations']);
    Route::get('/delivery-fee', [DeliveryController::class, 'getDeliveryFee']);
    
});

Route::post('dispatch-login', [DispatcherController::class, 'login']);
Route::post('dispatch-change-password', [DispatcherController::class, 'changePassword']);

Route::middleware(['auth:sanctum', 'verified', 'is.dispatcher'])->group(function () {
    Route::get('dispatcher/dashboard', [DispatcherController::class, 'index']);
    Route::get('dispatcher/orders', [DispatcherController::class, 'getAllOrders']);
    Route::post('dispatcher/order-complete', [DispatcherController::class, 'completeByTransactionId']);

});




// DispatcherController