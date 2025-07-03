<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query();

        // Optional: Add search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('fullName', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10); // Use pagination

        return view('admin.users.index', compact('users'));
        
    }
    

     public function edit($id)
    {
         $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
       
        $user = User::findOrFail($id);
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
    
    

}
