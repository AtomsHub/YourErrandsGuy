<?php

namespace App\Http\Controllers;

use App\Models\DeliveryFee;
use App\Models\ErrandsPackageDeliveryFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryFeeController extends Controller
{
    // ===== CRUD for delivery_fees =====
    
    public function indexDeliveryFees()
    {
        $fees = DeliveryFee::all();
        return response()->json($fees);
    }

    public function storeDeliveryFee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|integer',
            'landmark' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fee = DeliveryFee::create($validator->validated());
        return response()->json($fee, 201);
    }

    public function showDeliveryFee($id)
    {
        $fee = DeliveryFee::find($id);

        if (!$fee) {
            return response()->json(['message' => 'Delivery fee not found'], 404);
        }

        return response()->json($fee);
    }

    public function updateDeliveryFee(Request $request, $id)
    {
        $fee = DeliveryFee::find($id);

        if (!$fee) {
            return response()->json(['message' => 'Delivery fee not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'vendor_id' => 'sometimes|integer',
            'landmark' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fee->update($validator->validated());
        return response()->json($fee);
    }

    public function destroyDeliveryFee($id)
    {
        $fee = DeliveryFee::find($id);

        if (!$fee) {
            return response()->json(['message' => 'Delivery fee not found'], 404);
        }

        $fee->delete();
        return response()->json(['message' => 'Delivery fee deleted successfully']);
    }


    // ===== CRUD for errands_package_delivery_fees =====
    
    public function indexErrandFees()
    {
        $fees = ErrandsPackageDeliveryFee::all();
        return response()->json($fees);
    }

    public function storeErrandFee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickup' => 'required|string|max:255',
            'dropoff' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'vendor_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fee = ErrandsPackageDeliveryFee::create($validator->validated());
        return response()->json($fee, 201);
    }

    public function showErrandFee($id)
    {
        $fee = ErrandsPackageDeliveryFee::find($id);

        if (!$fee) {
            return response()->json(['message' => 'Errand package delivery fee not found'], 404);
        }

        return response()->json($fee);
    }

    public function updateErrandFee(Request $request, $id)
    {
        $fee = ErrandsPackageDeliveryFee::find($id);

        if (!$fee) {
            return response()->json(['message' => 'Errand package delivery fee not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'pickup' => 'sometimes|string|max:255',
            'dropoff' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'vendor_id' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fee->update($validator->validated());
        return response()->json($fee);
    }

    public function destroyErrandFee($id)
    {
        $fee = ErrandsPackageDeliveryFee::find($id);

        if (!$fee) {
            return response()->json(['message' => 'Errand package delivery fee not found'], 404);
        }

        $fee->delete();
        return response()->json(['message' => 'Errand package delivery fee deleted successfully']);
    }
}
