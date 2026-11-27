<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $akun = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($akun)) {
            $request->session()->regenerate();

            return redirect()->route('products.index');
        }

        return redirect()->route('login')
            ->withInput($request->only('email'))
            ->withErrors([
                'login_error' => 'Email atau password salah',
            ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
 