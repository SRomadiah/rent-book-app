<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    // public function profile(Request $request)
    // {
    //     $request->session()->flush();
    // }
    public function profile()
    {
        return view('profile');
    }
    public function index()
    {
        return view('users');
    }
}
