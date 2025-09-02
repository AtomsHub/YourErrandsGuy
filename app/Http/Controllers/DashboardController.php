<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
use App\Models\Vendor;
use App\Models\item;
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

        return ApiResponse::success([
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
                    'items' => $popular->vitems, // Include vitems if necessary
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
                    'items' => $vendor->vitems, // Include vitems if necessary
                ];
            }),
            'laundries' => $laundries->map(function ($laundry) {
                return [
                    'id' => $laundry->id,
                    'name' => $laundry->name,
                    'address' => $laundry->address,
                    'description' => $laundry->description,
                    'image' => $laundry->item->image ?? null, // Ensure correct image path
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
                            'image' => $item->image,
                            'created_at' => $item->created_at,
                            'updated_at' => $item->updated_at,
                        ];
                    })
                ];
           }),
            
            
            
            
            'message' => 'Welcome to your dashboard!',
        ]);
    }
}

// "id": 1,
// "name": "D kings Restaurant",
// "description": "Progressive multimedia standardization",
// "image": "https://via.placeholder.com/640x480.png/00bb88?text=food+consequuntur",
// "tag": "popular",
