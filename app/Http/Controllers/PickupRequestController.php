<?php

// app/Http/Controllers/PickupRequestController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickupRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\HandlesFileUploads;
use App\Http\Traits\LogsActivity;
use App\Http\Traits\AuthorizesOwnership;

class PickupRequestController extends Controller
{
    use HandlesFileUploads, LogsActivity, AuthorizesOwnership;
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'landmark' => 'required|string',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'message' => 'nullable|string',
        ]);

        $photoPath = $this->storeFile($request->file('photo'), 'photos');
        
        PickupRequest::create([
            'name' => $request->name,
            'address' => $request->address,
            'landmark' => $request->landmark,
            'photo' => $photoPath,
            'message' => $request->message,
            'user_id' => Auth::id(), 
            'status' => 'pending', 
        ]);

        $this->logRequestCreated();

        return redirect()->route('user.dashboard')->with('success', 'Pickup request submitted!');
    }

    public function userRequests()
    {
        $requests = PickupRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.my-requests', compact('requests'));
    }


    public function deleteRequest($id)
    {
        if ($redirect = $this->ensureAuthenticated('You must be logged in to delete a request.')) {
            return $redirect;
        }

        $request = PickupRequest::findOrFail($id);
        
        if ($redirect = $this->ensureOwnership($request, 'user_id', 'You are not authorized to delete this request.')) {
            return $redirect;
        }

        if ($request->status == 'pending') {
            $request->delete();
            $this->logRequestDeleted();
            return redirect()->route('user.my-requests')->with('success', 'Request deleted successfully.');
        }

        return redirect()->back()->with('error', 'Only pending requests can be deleted.');
    }

    public function editRequest($id)
    {
        if ($redirect = $this->ensureAuthenticated('You must be logged in to edit a request.')) {
            return $redirect;
        }

        $request = PickupRequest::findOrFail($id);
        
        if ($redirect = $this->ensureOwnership($request, 'user_id', 'You are not authorized to edit this request.')) {
            return $redirect;
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

        if ($redirect = $this->ensureOwnership($pickupRequest, 'user_id', 'You are not authorized to update this request.')) {
            return $redirect;
        }

        if ($photoPath = $this->handleImageUpload($request, 'photo', 'photos')) {
            $pickupRequest->photo = $photoPath;
        }

        $pickupRequest->name = $request->name;
        $pickupRequest->address = $request->address;
        $pickupRequest->landmark = $request->landmark;
        $pickupRequest->message = $request->message;
        $pickupRequest->save();

        $this->logRequestUpdated();

        return redirect()->route('user.my-requests')->with('success', 'Request updated successfully.');
    }

}