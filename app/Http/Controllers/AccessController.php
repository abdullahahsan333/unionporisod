<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{

    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    
    public function index()
    {
        return view('login');
    }

    public function login(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $credentials['status'] = 'active';

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard')->with(['success' => 'Login successful.']);
        }

        return redirect('admin/login')->with(['warning' => 'Login details are not valid.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with(['success' => 'Logout successful.']);
    }
}
