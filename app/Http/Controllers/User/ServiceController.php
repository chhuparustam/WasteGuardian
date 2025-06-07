<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        // You can pass services data here if needed
        return view('user.services.index');
    }
}
