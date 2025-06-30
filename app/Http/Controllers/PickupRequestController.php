<?php

// app/Http/Controllers/PickupRequestController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickupRequest;
use Illuminate\Support\Facades\Auth;

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
    PickupRequest::insert($data);

    return redirect('/#pickup-request')->with('success', 'Pickup request submitted!');
}

public function userRequests()
{
    // Use session or Auth depending on your setup
    $userId = session('user_id'); // or Auth::id() if using Laravel Auth

    $requests = \App\Models\PickupRequest::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.my-requests', compact('requests'));
}
}
