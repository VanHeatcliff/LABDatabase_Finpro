<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Coba Login menggunakan Guard 'admin'
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika sukses, redirect ke dashboard
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal
        return back()->withErrors(['email' => 'Email atau Password salah!']);
    }

    // Proses Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}