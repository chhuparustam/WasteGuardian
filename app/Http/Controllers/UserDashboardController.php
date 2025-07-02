<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as WasteRequest;
use App\Models\Complaint;
use App\Models\PickupRequest;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {  
       $data['totalRequests'] = PickupRequest::where('user_id', Auth::id())->count(); 
       $data['pendingRequests'] = PickupRequest::where('user_id', Auth::id())->where('status','pending')->count(); 
       $data['completedRequests'] = PickupRequest::where('user_id', Auth::id())->where('status','complete')->count(); 
       $data['recentActivities'] = Activity::where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get(); 
       return view('user.dashboard',$data);
    }
}