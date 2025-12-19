<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // PENTING: Untuk Hash Password
use App\Models\Pelanggan;
use App\Helpers\IDGenerator; // PENTING: Untuk ID PE001

class AuthController extends Controller
{
    // --- TAMBAHKAN FUNGSI INI ---
    // Fungsi ini bertugas menampilkan file View (Halaman HTML)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi ini bertugas memproses data POST dari form
    public function login(Request $request)
    {
        // Validasi
        $request->validate([
            'Email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'Email' => $request->Email,      // Key sesuai nama kolom DB
            'password' => $request->password // Key WAJIB 'password' kecil
        ];

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login Berhasil!');
        }

        return back()->withErrors([
            'Email' => 'Email atau password salah.',
        ])->onlyInput('Email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // 1. Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 2. Proses Register
    public function register(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:pelanggan', // Cek agar email tidak kembar
            'Telepon' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' akan mengecek input 'password_confirmation'
        ]);

        // B. Generate ID Pelanggan (PE001, PE002, ...)
        $idPelanggan = IDGenerator::generate('pelanggan', 'ID_Pelanggan', 'PE', 3);

        // C. Simpan ke Database
        $pelanggan = Pelanggan::create([
            'ID_Pelanggan' => $idPelanggan,
            'Nama' => $request->Nama,
            'Email' => $request->Email,
            'Telepon' => $request->Telepon,
            // AUTO HASH: Password langsung dienkripsi di sini
            'Password' => Hash::make($request->password), 
        ]);

        // D. Auto Login (Opsional: Langsung login setelah daftar)
        Auth::guard('pelanggan')->login($pelanggan);

        // E. Redirect ke Home
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}