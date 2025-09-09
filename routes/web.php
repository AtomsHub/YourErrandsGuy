<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryFeeController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/paystack/webhook', [OrderController::class, 'handleWebhook']);

// Route::post('/paystack/callback', [OrderController::class, 'paystackCallback']);

// Admin Login Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

// https://yourerrandsguy.com.ng/paystack/callback

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');


// Protect admin routes using 'admin' middleware
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', action: [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/restaurants', action: [AdminDashboardController::class, 'restaurants'])->name('admin.restaurants');

    // Customer Routes
    Route::controller(CustomerController::class)->prefix('customers')->group(function () {
        Route::get('/', 'index')->name('admin.customers.index');
        Route::get('/{id}', 'show')->name('admin.customers.show');
        Route::post('/', 'store')->name('admin.customers.store');
        Route::put('/{id}', 'update')->name('admin.customers.update');
        Route::delete('/{id}', 'destroy')->name('admin.customers.destroy');
    });

    // Order Routes
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('/', 'index')->name('admin.orders.index');
        Route::get('/{id}', 'show')->name('admin.orders.show');
        Route::post('/assign-dispatcher', 'assignDispatcher')->name('admin.orders.assign.dispatcher');
        Route::post('/', 'store')->name('admin.orders.store');
        Route::put('/{id}', 'update')->name('admin.orders.update');
        Route::delete('/{id}', 'destroy')->name('admin.orders.destroy');
    });

    // Restaurant Routes
    Route::controller(  VendorController::class)->prefix('restaurants')->group(function () {
        Route::get('/', 'index')->name('admin.restaurants.index');
        Route::get('/{id}', 'show')->name('admin.restaurants.show');
        Route::post('/', 'store')->name('admin.restaurants.store');
        Route::post('/{vendorId}', 'storeItem')->name('admin.restaurants.storeitem');
        Route::put('/{id}', 'updateItem')->name('admin.restaurants.updateitem');
        Route::delete('/{id}', 'destroyItem')->name('admin.restaurants.destroyitem');
    });



    // Item Routes
    Route::controller(ItemsController::class)->prefix('foods')->group(function () {
        Route::get('/', 'index')->name('admin.items.index');
        Route::get('/{id}', 'show')->name('admin.items.show');
        Route::post('/', 'store')->name('admin.items.store');
        Route::put('/{id}', 'update')->name('admin.items.update');
        Route::delete('/{id}', 'destroy')->name('admin.items.destroy');
    });

    // Dispatcher Routes
    Route::controller(DispatcherController::class)->prefix('dispatchers')->group(function () {
        Route::get('/', 'index')->name('admin.dispatchers.index');
        Route::get('/', 'show')->name('admin.dispatchers.show');
        Route::post('/', 'store')->name('admin.dispatchers.store');
        Route::post('/{id}/approve', 'approve')->name('dispatchers.approve');
        Route::post('/{id}/disapprove', 'disapprove')->name('dispatchers.disapprove');
        Route::put('/{id}', 'update')->name('admin.dispatchers.update');
        Route::delete('/{id}', 'destroy')->name('admin.dispatchers.destroy');
    });


    Route::prefix('delivery-fees')->group(function () {
        Route::get('/', [DeliveryFeeController::class, 'indexDeliveryFees']);
        Route::post('/', [DeliveryFeeController::class, 'storeDeliveryFee']);
        Route::get('/{id}', [DeliveryFeeController::class, 'showDeliveryFee']);
        Route::put('/{id}', [DeliveryFeeController::class, 'updateDeliveryFee']);
        Route::delete('/{id}', [DeliveryFeeController::class, 'destroyDeliveryFee']);
    });

    Route::prefix('errand-fees')->group(function () {
        Route::get('/', [DeliveryFeeController::class, 'indexErrandFees']);
        Route::post('/', [DeliveryFeeController::class, 'storeErrandFee']);
        Route::get('/{id}', [DeliveryFeeController::class, 'showErrandFee']);
        Route::put('/{id}', [DeliveryFeeController::class, 'updateErrandFee']);
        Route::delete('/{id}', [DeliveryFeeController::class, 'destroyErrandFee']);
    });
});
