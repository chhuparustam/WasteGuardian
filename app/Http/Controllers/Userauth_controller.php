<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Userauth_controller extends Controller
{
    public function login()
    {
        return view('auth.login'); // Return a login view

        //echo 'login page';
    }

    public function register(){

        return view('auth.register');
    }

    public function create(Request $request){
       // return $request->input();

       // validate request

       $request->validate([
        'fullName'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:5|max:12'

       ]);

       // creating user

       $user = User::create([
        'name' => $request->fullName,
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
