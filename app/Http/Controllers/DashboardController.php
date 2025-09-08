<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
use App\Helpers\VendorTransformer;
use App\Models\item;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $popular = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('tag','popular')->get();
        $vendors = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('service_type','Restaurant')->get();
        $laundries = Vendor::with('vitems','deliveryfee','vendorItems.item')->where('service_type','Laundry')->get();
        
        $popular->each(function ($vendor) {
            $vendor->vitems->each->makeHidden(['wash', 'starch', 'iron']);
        });
        
        $vendors->each(function ($vendor) {
            $vendor->vitems->each->makeHidden(['wash', 'starch', 'iron']);
        });

        $userOrders = Order::selectRaw('COUNT(*) as totalOrderCount, COALESCE(SUM(total_amount), 0) as totalAmountSpent')->where('user_id', $user->id)->first();
          

        return ApiResponse::success([
            
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
        ], 'Welcome to your dashboard!');


        


        

       
    }
}

// "id": 1,
// "name": "D kings Restaurant",
// "description": "Progressive multimedia standardization",
// "image": "https://via.placeholder.com/640x480.png/00bb88?text=food+consequuntur",
// "tag": "popular",
