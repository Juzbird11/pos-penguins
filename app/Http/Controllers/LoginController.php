<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('authenticated')) {
            return redirect('/');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        if($request->pin === env('PIN')) 
        {
            $request->session()->put('authenticated', time());
            return redirect('/');
        }

        return back()->with('pin', 'Invalid Pin');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
