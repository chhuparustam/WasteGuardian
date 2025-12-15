<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\LogsActivity;
use App\Http\Traits\AuthorizesOwnership;

class ComplaintController extends Controller
{
    use LogsActivity, AuthorizesOwnership;
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

        Complaint::insert([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
        ]);

        $this->logComplaintCreated($request->subject);

        return redirect()->route('user.complaints.index')
            ->with('success', 'Your complaint has been submitted successfully.');
    }
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())->latest()->get();
        return view('user.complaints.index', compact('complaints'));
    }


    public function delete($id)
    {
        $complaint = Complaint::findOrFail($id);
        
        if ($redirect = $this->ensureOwnership($complaint, 'user_id', 'You are not authorized to delete this complaint.')) {
            return $redirect;
        }

        if ($complaint->status === 'pending') {
            $complaint->delete();
            $this->logComplaintDeleted($complaint->subject);
            return redirect()->route('user.complaints.index')
                ->with('success', 'Complaint deleted successfully.');
        }

        return redirect()->back()->with('error', 'Only pending complaints can be deleted.');
    }
}