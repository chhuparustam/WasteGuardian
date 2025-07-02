<?php

// app/Http/Controllers/PickupRequestController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickupRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

class PickupRequestController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'address' => 'required|string',
        'landmark' => 'required|string',
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'message' => 'nullable|string',
    ]);

    $photoPath = $request->file('photo')->store('photos', 'public');
    $data = [
            'name' => $request->name,
            'address' => $request->address,
            'landmark' => $request->landmark,
            'photo' => $photoPath,
            'message' => $request->message,
            'user_id' => Auth::id(), 
            'status' => 'pending', 
    ];

    // dd($data);
    PickupRequest::create($data);

        Activity::create([
        'user_id' => Auth::id(),
        'type' => 'request_created',
        'description' => 'New waste collection request submitted',
    ]);

    return redirect()->route('user.dashboard')->with('success', 'Pickup request submitted!');
}

public function userRequests()
{
    // Use session or Auth depending on your setup
    $userId = Auth::id(); // or Auth::id() if using Laravel Auth

    $requests = \App\Models\PickupRequest::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();
    return view('user.my-requests', compact('requests'));
}


public function deleteRequest($id)
{
    if(!Auth::check() || !$id) {
        return redirect()->back()->with('error', 'You must be logged in to delete a request.');
    }

    $request = PickupRequest::findOrFail($id);
    
    // Check if the request belongs to the authenticated user
    if ($request->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this request.');
    }

    if($request->status == 'pending') {
        $request->delete();
        return redirect()->route('user.my-requests')->with('success', 'Request deleted successfully.');
    } else {
        return redirect()->back()->with('error', 'Only pending requests can be deleted.');
    }
    Activity::create([
        'user_id' => Auth::id(),
        'type' => 'request_deleted',
        'description' => 'Waste collection request deleted',
    ]);

    return redirect()->route('user.my-requests')->with('success', 'Request deleted successfully.');
}

public function editRequest($id)
{
    if(!Auth::check() || !$id) {
        return redirect()->back()->with('error', 'You must be logged in to edit a request.');
    }

    $request = PickupRequest::findOrFail($id);
    
    // Check if the request belongs to the authenticated user
    if ($request->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to edit this request.');
    }

    return view('user.edit-request', compact('request'));

}


public function updateRequest(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'address' => 'required|string',
        'landmark' => 'required|string',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'message' => 'nullable|string',
    ]);

    $pickupRequest = PickupRequest::findOrFail($id);

    // Check if the request belongs to the authenticated user
    if ($pickupRequest->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to update this request.');
    }

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $pickupRequest->photo = $photoPath;
    }

    $pickupRequest->name = $request->name;
    $pickupRequest->address = $request->address;
    $pickupRequest->landmark = $request->landmark;
    $pickupRequest->message = $request->message;

    $pickupRequest->save();

    Activity::create([
        'user_id' => Auth::id(),
        'type' => 'request_updated',
        'description' => 'Waste collection request updated',
    ]);

    return redirect()->route('user.my-requests')->with('success', 'Request updated successfully.');

}

}