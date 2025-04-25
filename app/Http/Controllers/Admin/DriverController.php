<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DriverModel;
use Illuminate\Http\Request;
// use App\Http\Controllers\Admin\DriverController;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = DriverModel::all();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        DriverModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver added successfully.');
    }

    public function edit($id)
    {
        $driver = DriverModel::findOrFail($id);
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,' . $id,
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $driver = DriverModel::findOrFail($id);
        $driver->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        $driver = DriverModel::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
