<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    //


    public function index()
    {
        return view('auth.login');
    } 


    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => url('/')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username atau password salah!'
        ], 401);
    }


    public function logout() {
        Session::flush();
        Auth::logout();
    
        return Redirect('/login');
    }

}
