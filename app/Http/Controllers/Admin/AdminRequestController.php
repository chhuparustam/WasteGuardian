<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DriverModel;
use App\Models\PickupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\TextMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\SearchableRecords;

class AdminRequestController extends Controller
{
    use SearchableRecords;

    public function index(Request $request)
    {
        $query = PickupRequest::query();
        $searchTerm = $request->input('search');
        $searchableFields = ['name', 'address', 'landmark', 'message'];

        $requests = $this->searchAndPaginate(
            $query->orderByDesc('created_at'), 
            $searchTerm, 
            $searchableFields, 
            10
        );

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
        $drivers = DriverModel::where('type', 'driver')->get();
        return view('admin.requests.show', compact('request', 'drivers'));
    }

    public function assignDriver(Request $request, $id)
    {
        $pickupRequest = PickupRequest::findOrFail($id);

        $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $pickupRequest->driver_id = $request->driver_id;
        $pickupRequest->status = 'Assigned';
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

        $user = User::where('id', $request->user_id)->first();
        Mail::raw("Your pickup request has been approved. Please contact us for further details.", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Request Approval Notification');
        });

        return redirect()
            ->route('admin.requests.show', $pickupRequest->id)
            ->with('success', 'Request Approved successfully.');
    }
}
