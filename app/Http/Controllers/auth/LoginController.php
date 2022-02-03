<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){

        //validate the form data
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Attempt to log the user in
        if(!auth()->attempt(request(['email', 'password'], 'remember'))){
            return back()->withErrors([
                'message' => 'Please check your credentials and try again'
            ]);
        }
        //if successful, then redirect to the home page
        return redirect()->route('home');
    }

    //logout
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
