<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login-form');
    }

    public function login(Request $request)
    {
        $credentials= $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1) {
                return redirect()->route('adminkota-dashboard');
            }

            if(Auth::user()->role_id == 2) {
                return redirect()->route('adminopd-tpp-pegawai');
            }

            if(Auth::user()->role_id == 3) {
                return redirect()->route('adminjabatan-jabatan');
            }
            // return redirect();
        }
        Alert::error('Login Gagal!', 'Akun Tidak Valid!');
        return redirect()->route('loginform');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginform');
    }
}
