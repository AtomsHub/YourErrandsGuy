<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    public function saveOrders(Request $request)
    {
        $userId = auth()->id(); // Logged-in user ID
        $cartItems = $request->input('cartItems');

        foreach ($cartItems as $cartItem) {
            // Insert into orders table
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'vendor_id' => $cartItem['services'] === 'Restaurant' ? $cartItem['restaurant_id'] : null,
                'service_type' => $cartItem['services'],
                'item_amount' => $cartItem['itemAmount'],
                'delivery_fee' => $cartItem['deliveryFee'],
                'total_amount' => $cartItem['totalAmount'],
                'form_details' => json_encode($cartItem['formDetails']),
            ]);

            // Insert into cart_items table
            foreach ($cartItem['items'] as $item) {
                DB::table('cart_items')->insert([
                    'order_id' => $orderId,
                    'description' => $item['description'] ?? $item['name'] ?? $item,
                    'quantity' => $item['quantity'] ?? 1,
                    'rate' => $item['rate'] ?? $item['price'] ?? null,
                ]);
            }
        }

        return response()->json(['message' => 'Orders saved successfully!']);
    }

    private function getRestaurantId($restaurantName)
    {
        return DB::table('vendors')->where('name', $restaurantName)->value('id');
    }

}
