<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register(){

        return view('auth.register');
    }

    public function create(Request $request){
       // return $request->input();

       // validate request

       $request->validate([
        'fullName'=>'required|String|min:2|max:50',
        'email' => ['required', 'email', 'unique:users,email', 'regex:/^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
        'password' => ['required','min:6'],
       ]);

       // creating user

       $user = User::create([
        'fullName' => $request->fullName,
        'email'=> $request->email,
        'password'=>bcrypt($request->password),
       ]);

       Auth::login($user);
       //return redirect()->route('login');
    }

    public function checkLogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12' 
        ]);

        $user = User::where('email',$email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                //return redirect()->route('dashboard');
            }else{
                $request->session()->flash('failed', 'Please enter correct password');
            }
        }else{
            $request->session()->flash('failed', 'User not found!');
        }

    }
}
