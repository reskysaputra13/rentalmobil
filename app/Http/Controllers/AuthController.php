<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function post(Request $request)
    {
        // dd(request()->all());
        $cre = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($cre)) {
            session()->regenerate();
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('warning', 'Username atau password anda salah!');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

}
