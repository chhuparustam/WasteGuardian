<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DriverModel;
use App\Models\PickupRequest;
use Illuminate\Http\Request;

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

        $requests = $query->orderByDesc('created_at')->paginate(10)->appends($request->all());

        return view('admin.requests.index', compact('requests'));
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
    $drivers =DriverModel::all(); // Adjust model name if needed
    return view('admin.requests.show', compact('request', 'drivers'));
}

public function assignDriver(Request $request, $id)
{
    $pickupRequest = PickupRequest::findOrFail($id);

    $request->validate([
        'driver_id' => 'required|exists:drivers,id',
    ]);

    $pickupRequest->driver_id = $request->driver_id;
    $pickupRequest->status = 'Assigned'; // Optional: set status if you have a status field
    $pickupRequest->save();

    return redirect()
        ->route('admin.requests.show', $pickupRequest->id)
        ->with('success', 'Driver assigned successfully.');
}
}
