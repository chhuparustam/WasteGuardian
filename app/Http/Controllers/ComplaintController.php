<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('user.complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $userName = auth()->user()->fullName ?? 'Guest';

        Complaint::create([
            'user_name' => $userName,
            'subject' => $request->subject,
            'description' => $request->description,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Your complaint has been submitted successfully.');
    }
    public function index()
{
    $userName = auth()->user()->fullName ?? 'Guest';

    // fetch data of currents complaints
    $complaints = Complaint::where('user_name', $userName)->latest()->get();

    return view('user.complaints.index', compact('complaints'));
}

}