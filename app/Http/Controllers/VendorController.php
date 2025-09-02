<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\VendorItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $newitems = Items::where('id',$validated['name'])->first();
        // Find the vendor
        $vendor = Vendor::findOrFail($vendorId);

        // Create and save the new item
        $item = new VendorItem();
        $item->vendor_id = $vendor->id;
        $item->name = $newitems->name;
        $item->price = $validated['price'];
         $item->items_id = $validated['name'];
     
        $item->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Item added successfully!');
    }

   public function updateItem(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|max:255', // this is the items_id
            'price' => 'required|numeric|min:0',
        ]);

        // Get the actual item from Items table
        $newitems = Items::where('id', $validated['name'])->firstOrFail();

        // Find the vendor item to update
        $item = VendorItem::findOrFail($id);
        $item->items_id = $validated['name']; // store items_id
        $item->name = $newitems->name;        // store item name
        $item->price = $validated['price'];   // update price

        $item->save();

        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    public function destroyItem($id)
    {
        $item = VendorItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }


    public function login(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Find vendor by username
        $vendor = Vendor::where('username', $request->username)->first();

        if (!$vendor || !Hash::check($request->password, $vendor->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate Sanctum token
        $token = $vendor->createToken('vendor_auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'vendor' => [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'username' => $vendor->username,
                    'email' => $vendor->email ?? null,
                    'phone' => $vendor->phone ?? null,
                    'address' => $vendor->address ?? null,
                    'description' => $vendor->description,
                    'image' => $vendor->image,
                    'tag' => $vendor->tag,
                    'walletBalance' => $vendor->walletBalance,
                ],
            ]
        ], 200);
    }


    public function dashboard(Request $request)
    {
        $user = $request->user();
        $vendor = Vendor::where('id', $user->id)->first();

        $orders = Order::where('vendor_id', $user->id)
            ->with(['cartItems', 'dispatcher','vendor','customer'])
            ->orderBy('created_at', 'desc')
            ->take(10) // ✅ only recent 10
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'successful',
            'data' => [
                'orders' => $orders,
                 'vendor' => [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'username' => $vendor->username,
                    'email' => $vendor->email ?? null,
                    'phone' => $vendor->phone ?? null,
                    'address' => $vendor->address ?? null,
                    'description' => $vendor->description,
                    'image' => $vendor->image,
                    'tag' => $vendor->tag,
                    'walletBalance' => $vendor->walletBalance,
                ],
            ]
        ], 200);
    }


    public function process($id)
    {
        // Check if id is empty
        if (empty($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Order ID is required.'
            ], 400); // 400 Bad Request
        }

        try {
            $Order = Order::with(['customer', 'vendor'])->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.'
            ], 404);
        }

        $Order->status = 'Processing';
        $Order->save();

        Mail::send('emails.order_processed', [
            'user_name' => $Order->customer->full_name,
            'order_id' => $Order->id,
            'provider_name' => $Order->vendor->name,
            'provider_phone_number' => $Order->vendor->phone_number,
        ], function ($message) use ($Order) {
            $message->to($Order->customer->email);
            $message->subject('Order Assigned To Dispatcher');
        });

        return response()->json([
            'success' => true,
            'message' => 'Thanks for processing your order.'
        ], 200);
    }


    public function showapi(Request $request)
    {
        $authVendor = $request->user();

        // Ensure vendor is authenticated
        if (!$authVendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Vendor not authenticated.',
            ], 401);
        }

        // Load vendor with vendorItems and their related item
        $vendor = Vendor::with('vendorItems.item')->find($authVendor->id);

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Vendor not found.',
            ], 404);
        }

        // Vendor's items (image comes from Item table)
        $items = $vendor->vendorItems->map(function ($vendorItem) use ($vendor) {
            $itemData = [
                'id'          => $vendorItem->id,
                'name'        => $vendorItem->item->name ?? null,
                'description' => $vendorItem->item->description ?? null,
                'image'       => $vendorItem->item->image ?? null,
                'created_at'  => $vendorItem->created_at,
                'updated_at'  => $vendorItem->updated_at,
            ];

            if ($vendor->service_type === "Lundary") {
                $itemData['price'] = [
                    'wash'   => (float) $vendorItem->wash,
                    'iron'   => (float) $vendorItem->iron,
                    'starch' => (float) $vendorItem->starch,
                ];
            } elseif ($vendor->service_type === "restaurant") {
                $itemData['price'] = (float) $vendorItem->item->price;
            }

            return $itemData;
        });

        // All available new items (from Items table)
      

        return response()->json([
            'success' => true,
            'message' => 'Vendor fetched successfully',
            'data' => [
                'vendor' => [
                    'id'          => $vendor->id,
                    'name'        => $vendor->name,
                    'username'    => $vendor->username,
                    'email'       => $vendor->email,
                    'phone'       => $vendor->phone,
                    'address'     => $vendor->address,
                    'description' => $vendor->description,
                    'serviceType' => $vendor->service_type,
                    'image'       => $vendor->image, // vendor's logo/banner (not item image)
                    'tag'         => $vendor->tag,
                    'wallet'      => (float) $vendor->walletBalance,
                    'items'       => $items,
                ],
            ]
        ], 200);
    }





    // public function showapi(Request $request)
    // {
    //     $authVendor = $request->user();

    //     // Ensure vendor is authenticated
    //     if (!$authVendor) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized. Vendor not authenticated.',
    //         ], 401);
    //     }

    //     // Load vendor with vendorItems and their related item
    //     $vendor = Vendor::with('vitems','vendorItems.item')->find($authVendor->id);

    //     if (!$vendor) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Vendor not found.',
    //         ], 404);
    //     }

    //     // Vendor's own items (with image coming from Item table)
    //     $items = $vendor->vitems->map(function ($vendorItem) {
    //         return [
    //             'id' => $vendorItem->id,
    //             'name' => $vendorItem->name,
    //             'price' => $vendorItem->price,
    //             'description' => $vendorItem->description,
    //             'image' =>  $vendorItem->item->image ?? null,
    //         ];
    //     });

    //     // All available new items (from Items table)
    //     $newitems = Items::all()->unique('name')->sortBy('id');

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Vendor fetched successfully',
    //         'data' => [
    //             'vendor' => $vendor
                
               
    //         ]
    //     ], 200);
    // }



    public function updateItemapi(Request $request, $id)
    {
        $authVendor = $request->user();

        if (!$authVendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Vendor not authenticated.',
            ], 401);
        }

        $validated = $request->validate([
          
            'price' => 'required|numeric|min:0'
        ]);

       

        $vendorItem = VendorItem::where('id', $id)
            ->where('vendor_id', $authVendor->id)
            ->first();

        if (!$vendorItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found for this vendor.',
            ], 404);
        }

        // Update directly
        $vendorItem->update([
        
            'price'    => $validated['price']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully',
            'data' => $vendorItem
        ], 200);
    }


    public function destroyItemapi(Request $request, $id)
    {
        $authVendor = $request->user();

        if (!$authVendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Vendor not authenticated.',
            ], 401);
        }

        $item = VendorItem::where('id', $id)
            ->where('vendor_id', $authVendor->id)
            ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found for this vendor.',
            ], 404);
        }

        $item->delete(); // soft delete

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully',
        ], 200);
    }







}
