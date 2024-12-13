<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
   
    public function showLoginForm()
    {
        return view('auth.login');
    }

 
    public function login(Request $request)
    {
       
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
           
            Auth::login($user);  


            return redirect()->intended('/items');
        }


        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

  
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
