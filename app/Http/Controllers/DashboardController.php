<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
use App\Models\Vendor;
use App\Models\item;
use Illuminate\Http\Request;
use App\Helpers\VendorTransformer;

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


        return ApiResponse::success([
            
            'user' => [
                'id'       => $user->id,
                'fullname' => $user->fullname,
                'email'    => $user->email,
                'phone'    => $user->phone,
                'dob'      => $user->dob,
                'address'  => $user->address ?? null,
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
