<?php

// app/Http/Controllers/PickupRequestController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickupRequest;

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

    PickupRequest::create([
        'name' => $request->name,
        'address' => $request->address,
        'landmark' => $request->landmark,
        'photo' => $photoPath,
        'message' => $request->message,
    ]);

    return redirect('/#pickup-request')->with('success', 'Pickup request submitted!');
}

}
