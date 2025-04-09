<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Food;
use App\Models\Vendor;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = User::count();
        $totalOrders = Order::count();
        // $totalFoods = Food::count();
        $totalVendors = Vendor::count();

        return view('admin.index', compact('totalCustomers', 'totalOrders', 'totalVendors'));
    }
}
