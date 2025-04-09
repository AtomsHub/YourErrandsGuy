<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\FoodController;
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

// Admin Login Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

// Protect admin routes using 'admin' middleware
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', action: [AdminDashboardController::class, 'index'])->name('admin.dashboard');

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
        Route::post('/', 'store')->name('admin.orders.store');
        Route::put('/{id}', 'update')->name('admin.orders.update');
        Route::delete('/{id}', 'destroy')->name('admin.orders.destroy');
    });

    // Restaurant Routes
    Route::controller(  VendorController::class)->prefix('restaurants')->group(function () {
        Route::get('/', 'index')->name('admin.restaurants.index');
        Route::get('/{id}', 'show')->name('admin.restaurants.show');
        Route::post('/', 'store')->name('admin.restaurants.store');
        Route::put('/{id}', 'update')->name('admin.restaurants.update');
        Route::delete('/{id}', 'destroy')->name('admin.restaurants.destroy');
    });

    // Food Routes
    Route::controller(FoodController::class)->prefix('foods')->group(function () {
        Route::get('/', 'index')->name('admin.foods.index');
        Route::get('/{id}', 'show')->name('admin.foods.show');
        Route::post('/', 'store')->name('admin.foods.store');
        Route::put('/{id}', 'update')->name('admin.foods.update');
        Route::delete('/{id}', 'destroy')->name('admin.foods.destroy');
    });

    // Dispatcher Routes
    Route::controller(DispatcherController::class)->prefix('dispatchers')->group(function () {
        Route::get('/', 'index')->name('admin.dispatchers.index');
        Route::get('/{id}', 'show')->name('admin.dispatchers.show');
        Route::post('/', 'store')->name('admin.dispatchers.store');
        Route::put('/{id}', 'update')->name('admin.dispatchers.update');
        Route::delete('/{id}', 'destroy')->name('admin.dispatchers.destroy');
    });
});
