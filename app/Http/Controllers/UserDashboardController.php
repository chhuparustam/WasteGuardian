<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as WasteRequest;
use App\Models\Complaint;

class UserDashboardController extends Controller
{
    public function index()
    {

        
        return view('user.dashboard');
    }
}