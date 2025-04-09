<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Custom\ApiResponse;

class DeliveryController extends Controller
{
    // Get all unique pickup locations
    public function getPickupLocations()
    {
        $pickups = DB::table('errands_package_delivery_fees')->distinct()->pluck('pickup');

         return ApiResponse::success($pickups, 'Pickups fetched successfully');
    }

    // Get available dropoff locations based on selected pickup
    public function getDropoffLocations($pickup)
    {
        $dropoffs = DB::table('errands_package_delivery_fees')
            ->where('pickup', $pickup)
            ->pluck('dropoff');
            
            
        //  $dropoffs = DB::table('errands_package_delivery_fees')
        //     ->where('pickup', $pickup)
        //     ->orWhere('dropoff', $pickup)
        //     ->pluck('dropoff');
            
        if ($dropoffs->isEmpty()) {
            return ApiResponse::notFound('No dropoff locations found for the selected pickup');
        }
        
         return ApiResponse::success($dropoffs, 'Dropoffs fetched successfully');
    }

    // Get delivery fee for selected pickup and dropoff
    public function getDeliveryFee(Request $request)
    {
        $request->validate([
            'pickup' => 'required|string',
            'dropoff' => 'required|string'
        ]);

        $pickup = $request->pickup;
        $dropoff = $request->dropoff;

        $fee = DB::table('errands_package_delivery_fees')
            ->where(function ($query) use ($pickup, $dropoff) {
                $query->where('pickup', $pickup)->where('dropoff', $dropoff);
            })
            ->orWhere(function ($query) use ($pickup, $dropoff) {
                $query->where('pickup', $dropoff)->where('dropoff', $pickup);
            })
            ->first();
        $price = $fee ? $fee->price : 1000;
            
        return ApiResponse::success($price, 'Price fetched successfully');
    }
}
