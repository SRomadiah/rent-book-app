<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function authenticating(Request $request)
    {
        // untuk mengecek apakah data ada di database
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // untuk mengecek login valid
        if (Auth::attempt($credentials)) {

            // return redirect()->intended('dashboard');
            if (Auth::user()->status != 'active') {
                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet. please contact admin!');
                return redirect('/login');
            }
            // $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
                return redirect('dashboard');
            }
            if (Auth::user()->role_id == 2) {
                return redirect('profile');
            }
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login invalid');
        return redirect('/login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
