<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use Illuminate\Http\Request;

class DispatcherController extends Controller
{
    public function index()
    {
        return view ('admin.dispatchers');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:dispatchers,email',
            'home_address' => 'required|string',
            'date_of_birth' => 'required|date',
            'national_id_number' => 'required|string|unique:dispatchers,national_id_number',
            'driver_license_number' => 'required|string|unique:dispatchers,driver_license_number',
            'motorbike_license_plate_number' => 'required|string',
            'bank_account_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_name' => 'required|string',
        ]);



                $idDocumentPath = null;

                if (isset($request['id_document'])) {

                if ($request->hasFile('id_document')) {
                $docs = $request->file('id_document');
                $filename = $docs->getClientOriginalName(); // yam.jpg
                $destinationPath = public_path('documents');

                // Move image to public folder
                $docs->move($destinationPath, $filename);

                // Save correct public path in DB
                $idDocumentPath = 'documents/' . $filename;
                }
                }


        Dispatcher::create([
            'full_name' => $validated['full_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'home_address' => $validated['home_address'],
            'date_of_birth' => $validated['date_of_birth'],
            'national_id_number' => $validated['national_id_number'],
            'driver_license_number' => $validated['driver_license_number'],
            'id_document_path' => $idDocumentPath,
            'motorbike_license_plate_number' => $validated['motorbike_license_plate_number'],
            'bank_account_name' => $validated['bank_account_name'],
            'bank_account_number' => $validated['bank_account_number'],
            'bank_name' => $validated['bank_name'],
            'status' => 'unapproved', // Default to active
        ]);

        return redirect()->route('admin.dispatchers.store')->with('success', 'Dispatcher registered successfully.');
    }


    public function approve($id)
    {
        $dispatcher = Dispatcher::findOrFail($id);
        $dispatcher->status = 'approved';
        $dispatcher->save();

        return response()->json(['message' => 'Dispatcher approved.']);
    }

    public function show()
    {
        $approved = Dispatcher::where('status', 'approved')->get();
        $unapproved = Dispatcher::where('status', 'unapproved')->get();

        return view('admin.dispatchers', compact('approved', 'unapproved'));
    }
}
