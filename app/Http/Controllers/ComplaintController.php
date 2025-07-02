<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

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

        $data = [
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
        ];
      
        Complaint::insert($data);

        Activity::create([
            'user_id' => Auth::id(),
            'type' => 'complaint',
            'description' => 'Complaint Created: ' . $request->subject,

        ]);

        return redirect()->route('user.complaints.index')
            ->with('success', 'Your complaint has been submitted successfully.');
    }
    public function index()
{
    

    // fetch data of currents complaints
    $complaints = Complaint::where('user_id', Auth::id())->latest()->get();

    return view('user.complaints.index', compact('complaints'));
}


public function delete($id)
{
    $complaint = Complaint::findOrFail($id);
    
    // Check if the authenticated user is the owner of the complaint
    if ($complaint->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this complaint.');
    }

    if($complaint->status === 'pending') {
        $complaint->delete();
    }else {
        return redirect()->back()->with('error', 'Only pending complaints can be deleted.');
    }

    Activity::create([
        'user_id' => Auth::id(),
        'type' => 'complaint_deleted',
        'description' => 'Complaint Deleted: ' . $complaint->subject,
    ]);

    return redirect()->route('user.complaints.index')
        ->with('success', 'Complaint deleted successfully.');

}
}