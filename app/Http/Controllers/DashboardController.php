<?php

namespace App\Http\Controllers;

use App\Custom\ApiResponse;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $vendors = Vendor::with('items')->where('tag','popular')->get();

        return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'fullname' => $user->fullname,
                'email' => $user->email,
                'phone' => $user->phone,
                'dob' => $user->dob,
            ],
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
            'message' => 'Welcome to your dashboard!',
        ]);
    }
}

// "id": 1,
// "name": "D kings Restaurant",
// "description": "Progressive multimedia standardization",
// "image": "https://via.placeholder.com/640x480.png/00bb88?text=food+consequuntur",
// "tag": "popular",
