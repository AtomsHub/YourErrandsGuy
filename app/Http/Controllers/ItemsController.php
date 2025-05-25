<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorItem;
use App\Models\Items;



class ItemsController extends Controller
{
    public function index(){


        $items = Items::all()->unique('name')->sortBy('id');


            return view ('admin.foods', [
             'items' => $items
            ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            //'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1999',
        ]);

        $profileImage = null;

        if (isset($request['image'])) {
           //$profileImage = $request['image']->store('images/items', 'public');
           // $profileImage = $request->file('image')->store('images/items', 'public');
           if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName(); // yam.jpg
            $destinationPath = public_path('images/items');

            // Move image to public folder
            $image->move($destinationPath, $filename);

            // Save correct public path in DB
            $profileImage = 'images/items/' . $filename;
        }


        }

        $items = new Items();
        $items->name = $validated['name'];
        $items->category = $validated['category'];
        $items->image = $profileImage;
        $items->save();


        //Items::create($validated);

        return redirect()->back()->with('success', 'Item added successfully!');

 }

 public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $item = Items::findOrFail($id);
    $item->name = $validated['name'];
    $item->save();

    return redirect()->back()->with('success', 'Item updated successfully!');
}



}
