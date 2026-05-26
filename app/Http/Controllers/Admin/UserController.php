<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Traits\SearchableRecords;

class UserController extends Controller
{
    use SearchableRecords;

    public function index()
    {
        $query = User::query();
        $searchTerm = request('search');
        $searchableFields = ['fullName', 'email'];

        $users = $this->searchAndPaginate($query, $searchTerm, $searchableFields, 10);

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
