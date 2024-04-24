<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\once;

class AuthController extends Controller
{
    public function login_view(){
        return view('login');
    }
    public function registration_view(){
        return view('register');
    }

    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required|',
            'password' => 'required|',

        ]);


        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'))->with('success', "You are logined!");
        }

        return redirect(route('login_view'))->with("error", "Login details are not valid");

    }

    public function registerPost(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|',
        ]);

        $user = \App\Models\User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        if(!$user){
            return redirect(route('register_view'))->with("error", "Error Register");

        }
        return redirect(route('login_view'))->with('success', 'You are registered');

    }


    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login_view'));
    }


}




















