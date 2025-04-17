<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorItem;



class FoodController extends Controller
{
    public function index(){


        $items = VendorItem::all()->unique('name')->sortBy('id');


            return view ('admin.foods', [
             'items' => $items
            ]);




    }


}
