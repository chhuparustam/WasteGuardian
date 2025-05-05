<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;

class AdminRequestController extends Controller
{
    public function index()
    {
        $requests = PickupRequest::latest()->get();
        return view('admin.requests.index', compact('requests'));
    }
}
