<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    //
    public function index()
    {
        try {
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
        }
    }
}
