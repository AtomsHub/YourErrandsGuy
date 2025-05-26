<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorItem;
use App\Models\Items;
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
    $items = $vendor->items->unique('name');
    $newitems = Items::all()->unique('name')->sortBy('id');

    return view('admin.restaurants.restaurant', [
        'items' => $items,
        'newitems' => $newitems
    ], compact('vendor'));
}


public function storeItem($vendorId)
{
    // Validate incoming request data
    $validated = request()->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    // Find the vendor
    $vendor = Vendor::findOrFail($vendorId);

    // Create and save the new item
    $item = new VendorItem();
    $item->vendor_id = $vendor->id;
    $item->name = $validated['name'];
    $item->price = $validated['price'];
    $item->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Item added successfully!');
}

public function updateItem(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    $item = VendorItem::findOrFail($id);
    $item->update($validated);

    return redirect()->back()->with('success', 'Item updated successfully!');
}

public function destroyItem($id)
{
    $item = VendorItem::findOrFail($id);
    $item->delete();

    return redirect()->back()->with('success', 'Item deleted successfully!');
}




}
