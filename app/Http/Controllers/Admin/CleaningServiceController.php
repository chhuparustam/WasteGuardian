<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CleaningService;
use Illuminate\Http\Request;

class CleaningServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = CleaningService::all();
        return view('admin.cleaning_services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cleaning_services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
        ]);
        $service = new CleaningService($request->all());
        if ($request->hasFile('image')) {
            $service->image = $request->file('image')->store('services', 'public');
        }
        $service->save();
        return redirect()->route('admin.cleaning-services.index')
            ->with('success', 'Cleaning service has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = CleaningService::findOrFail($id);
        return view('admin.cleaning_services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = CleaningService::findOrFail($id);
        $service->update($request->all());
        if ($request->hasFile('image')) {
            $service->image = $request->file('image')->store('services', 'public');
            $service->save();
        }
        return redirect()->route('admin.cleaning-services.index')
            ->with('success', 'Cleaning service has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = CleaningService::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.cleaning-services.index')
            ->with('success', 'Cleaning service has been deleted successfully!');
    }
}
