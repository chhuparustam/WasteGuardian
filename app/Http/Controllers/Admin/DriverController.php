<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DriverModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\SearchableRecords;

class DriverController extends Controller
{
    use SearchableRecords;

    public function index()
    {
        $query = DriverModel::where('type', 'driver');
        $searchTerm = request('search');
        $searchableFields = ['fullName', 'email', 'phone', 'address'];

        $drivers = $this->searchAndPaginate($query, $searchTerm, $searchableFields, 10);

        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        DriverModel::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
           'password' => Hash::make($request->password),
           'type' => 'driver',
            // 'user' => $request->user, // Assuming 'user' is a field
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
        // dd($request->all());
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,' . $id,
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $driver = DriverModel::findOrFail($id);
        $driver->update([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            // 'password' => $request->password,
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
