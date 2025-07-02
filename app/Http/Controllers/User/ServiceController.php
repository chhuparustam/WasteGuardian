<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CleaningService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = CleaningService::all();
        return view('user.services.index', compact('services'));
    }

    public function show($id)
    {
        $service = CleaningService::findOrFail($id);
        return view('user.services.show', compact('service'));
    }
}
