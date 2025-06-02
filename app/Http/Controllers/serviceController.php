<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Show service details
    public function show($service)
    {
        // Example static data, replace with DB/model if needed
        $services = [
            'office-cleaning' => [
                'title' => 'Office Cleaning',
                'description' => 'Professional office cleaning for a healthy workspace.',
                'price' => 820,
                'image' => 'images/services/people-taking-care-office-cleaning.jpg',
            ],
            // Add more services as needed
        ];

        if (!isset($services[$service])) {
            abort(404);
        }

        return view('services.show', [
            'service' => $services[$service]
        ]);
    }

    // Handle booking (and redirect to payment)
    public function book(Request $request, $service)
    {
        // Validate and save booking info here
        // Redirect to eSewa or show payment instructions
        return redirect()->route('services.show', $service)
            ->with('success', 'Proceed to payment via eSewa.');
    }
}
