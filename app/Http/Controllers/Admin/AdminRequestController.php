<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DriverModel;
use App\Models\PickupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\TextMail;
use Illuminate\Support\Facades\Mail;

class AdminRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = PickupRequest::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('landmark', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $sortable = ['id', 'name', 'address', 'landmark', 'message', 'created_at'];
        $sort = $request->input('sort', 'created_at');
        if (!in_array($sort, $sortable)) {
            $sort = 'created_at';
        }
        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $requests = $query->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('admin.requests.index', compact('requests', 'sort', 'direction'));
    }

    public function destroy($id)
    {
        $request =PickupRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.requests.index')
            ->with('success', 'Request deleted successfully.');
    }

    public function show($id)
{
    $request = PickupRequest::findOrFail($id);
    $drivers =DriverModel::where('type','driver')->get(); // Adjust model name if needed
    return view('admin.requests.show', compact('request', 'drivers'));
}

public function assignDriver(Request $request, $id)
{
    $pickupRequest = PickupRequest::findOrFail($id);

    $request->validate([
        'driver_id' => 'required|exists:users,id',
    ]);

    $pickupRequest->driver_id = $request->driver_id;
    $pickupRequest->status = 'Assigned'; // Optional: set status if you have a status field
    $pickupRequest->save();

    return redirect()
        ->route('admin.requests.show', $pickupRequest->id)
        ->with('success', 'Driver assigned successfully.');
}
public function approveRequest(Request $request, $id)
{
    $pickupRequest = PickupRequest::findOrFail($id);

    $pickupRequest->status = 'Approved';
    $pickupRequest->save();

   $user =  User::where('id', $request->user_id)->first();
   Mail::raw("Your pickup request has been approved. Please contact us for further details.", function ($message) use ($user) {
    $message->to($user->email)
            ->subject('Request Approval Notification');
    });

    return redirect()
        ->route('admin.requests.show', $pickupRequest->id)
        ->with('success', 'Request Approved successfully.');
}
}
