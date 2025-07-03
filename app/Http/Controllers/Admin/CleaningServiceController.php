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
    public function indexFront()
    {
        $services = CleaningService::all();
        // dd($services); // Debugging line to check if services are fetched correctly
        return view('index', compact('services'));
    }


    public function serviceDetailFront($id)
    {
        $service = CleaningService::findOrFail($id);
        return view('user.services.show', compact('service'));
    }

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
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $service = new CleaningService($request->except('image'));

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
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $service = CleaningService::findOrFail($id);
        $service->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $service->image = $request->file('image')->store('services', 'public');
        }

        $service->save();

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
