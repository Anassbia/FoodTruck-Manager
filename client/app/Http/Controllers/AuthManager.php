<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function loginOrRegister(Request $request){
        if ($request->has('register')) {
        
            
            $request->validate([
                'full-name' => 'required|string|max:255',
                'date' => 'required|date',
                'email' => 'required|email|unique:clients,email', 
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'nullable|string|max:15', 
            ]);

            
            $fullName = explode(' ', $request->input('full-name'));
            $firstName = $fullName[0];
            $lastName = isset($fullName[1]) ? $fullName[1] : ''; 

            
            $client = Client::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $request->input('email'),
                'birthday' => $request->input('date'),
                 'phone' => $request->input('phone') ?? '',  
                'password' => Hash::make($request->input('password')),
            ]);

            if ($client) {
                Auth::login($client); 
                return redirect(route('profile')); 
            }

            return redirect(route('login'))->with("error", "Registration failed, please try again.");
        } else {
            
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

           
            if (Auth::attempt($credentials)) {
                return redirect()->intended(route('profile')); 
            }

            return redirect(route('login'))->with("error", "Login failed, please try again.");
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('home')); 
    }
}
