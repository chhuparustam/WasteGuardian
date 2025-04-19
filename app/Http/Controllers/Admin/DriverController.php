<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use  App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function index() {
        $drivers = Driver::all();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create() {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:drivers,email',
        'phone' => 'required', 'digits:10', 'numeric',
        'address' => 'required|string|nullable',
        'password' => 'required|min:6',
    ]);

    // Save driver
    $driver = new Driver();
    $driver->name = $request->name;
    $driver->email = $request->email;
    $driver->phone = $request->phone;
    $driver->address = $request->address;
    $driver->password = bcrypt($request->password);
    $driver->save();

    return redirect()->route('admin.drivers.index')->with('success', 'Driver added successfully!');
}

}