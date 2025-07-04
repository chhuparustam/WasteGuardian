<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CleaningService;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = CleaningService::all();
        return view('user.services.index', compact('services'));
    }

    public function show($id)
    {
        if(!Auth::check() || !$id) {
        return redirect()->route('login')->with('error', 'You must be logged in to delete a request.');
        }

        $service = CleaningService::findOrFail($id);
        return view('user.services.show', compact('service'));
    }

    public function store(Request $request,$id)
    {
        if(!Auth::check() || !$id) {
            return redirect()->route('login')->with('error', 'You must be logged in to book a service.');
        }

        $service = CleaningService::findOrFail($id);
        $user = Auth::user();

        $data= [
            'user_id' => $user->id,
            'cleaning_service_id' => $service->id,
            'details' => $request->input('special_notes'),
            'amount' => $service->price,
            'payment' => 'pending',
            'status' => 'pending',
            'booking_date' => $request->input('booking_date'),
            'booking_time' => $request->input('booking_time'),
        ];
        $booking = ServiceBooking::create($data);
        
        Activity::create([
            'user_id' => $user->id,
            'description' => 'Booked service: ' .( $service->cleaningService->title ?? ''),
            'type' => 'service_booking',
        ]);

        return redirect()->route('user.services.index')->with('success', 'Service booked successfully!');
    }

    public function bookedServices(){
        
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to book a service.');
        }

       $data['bookings'] = ServiceBooking::with('cleaningService')->where('user_id', Auth::id())->get();
        // dd($data);
       return view('user.services.booked-services',$data);

    }

    public function bookedServicesCancel($id){
        if(!Auth::check()  && !$id) {
            return redirect()->route('login')->with('error', 'You must be logged in to book a service.');
        }
       $booking = ServiceBooking::find($id);

       if($booking){
        $booking->where('id',$id)->update(['status' =>'cancel']);
        return redirect()->route('user.services.booked')->with('success', 'Service Cancel successfully!');
       }
    }
}
