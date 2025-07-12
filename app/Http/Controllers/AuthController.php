<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/pegawai');
        }
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }   
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
