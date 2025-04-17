<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorItem;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    //
    public function index()
    {
      /*  try {
            // Fetch vendors with their items
            $vendors = Vendor::with('items')->get();

            // Return a standardized success response
            return response()->json([
                'success' => true,
                'message' => 'Vendors retrieved successfully.',
                'data' => $vendors,
            ], 200);

        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve vendors.',
                'error' => $e->getMessage(),
            ], 500);
        }*/
        $restaurants = Vendor::all()->sortBy('id');

        return view ('admin.restaurants.index', [
         'restaurants' => $restaurants
        ]);

    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'service_type' => 'required|string|max:255',
    ]);

    Vendor::create($validated);

    return redirect()->back()->with('success', 'Vendor added successfully!');
}

public function show($id)
{
    $vendor = Vendor::findOrFail($id);
    $items = $vendor->items; // Assuming there's a relation

    return view('admin.restaurants.restaurant', [
        'items' => $items
    ], compact('vendor'));
}

public function storeItem(Request $request, $id)
{
    $vendor = Vendor::findOrFail($id);

    // Validate just the item fields
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|string|max:255',
    ]);

    // Manually add the vendor_id after validation
    $validated['vendor_id'] = $vendor->id;

    VendorItem::create($validated);

    return redirect()->back()->with('success', 'Item added successfully!');
}
}
