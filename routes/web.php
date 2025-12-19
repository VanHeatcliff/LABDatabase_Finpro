<?php

use Illuminate\Support\Facades\Route;

// --- 1. IMPORT CONTROLLER (Pastikan Namespace Benar) ---
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Keranjang\KeranjangController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Admin\DashboardController;
// Controller Admin lainnya
use App\Http\Controllers\Diskon\DiskonController;
use App\Http\Controllers\Ulasan\UlasanController; 
use App\Http\Controllers\Admin\AdminAuthController;

// PENTING: Import Checkout & Pesanan dari folder 'Pesanan'
use App\Http\Controllers\Pesanan\CheckoutController;
use App\Http\Controllers\Pesanan\PesananController;
use App\Http\Controllers\Admin\AdminController;


/*
|--------------------------------------------------------------------------
| 2. PUBLIC ROUTES (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Halaman Home
Route::get('/', function () {
    return view('home'); 
})->name('home');

// Halaman Katalog (Lihat Barang)
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');


/*
|--------------------------------------------------------------------------
| 3. GUEST ROUTES (Hanya untuk yang BELUM login)
|--------------------------------------------------------------------------
| Login & Register ada di sini.
*/
Route::middleware('guest:pelanggan')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});


/*
|--------------------------------------------------------------------------
| 4. PELANGGAN ROUTES (Harus LOGIN sebagai Pelanggan)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:pelanggan'])->group(function () {
    
    // --- LOGOUT ---
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- KERANJANG ---
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    // --- CHECKOUT & PROSES PESANAN (UPDATED) ---
    // 1. Menampilkan halaman checkout (Method 'create' di PesananController memuat data bank)
    Route::get('/checkout', [PesananController::class, 'create'])->name('checkout.index');
    
    // 2. Memproses/Menyimpan Pesanan (INI YANG MENGATASI ERROR "Route not defined")
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    
    // Melihat Riwayat Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    // Route Konfirmasi Pembayaran
    Route::post('/pesanan/{id}/konfirmasi', [PesananController::class, 'konfirmasiPembayaran'])->name('pesanan.konfirmasi');

    // --- RIWAYAT PESANAN ---
    Route::get('/riwayat-pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');

    // --- PROFIL ---
    Route::get('/profile', [PelangganController::class, 'profile'])->name('pelanggan.profile');
});


/*
|--------------------------------------------------------------------------
| 5. ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// A. ROUTE LOGIN (Bisa diakses tanpa login)
Route::prefix('admin')->group(function() {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// B. ROUTE DASHBOARD & MANAJEMEN (Harus LOGIN sebagai Admin)
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // 2. Dashboard (Menggunakan DashboardController yang di folder Admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 3. CRUD Produk, Diskon, Ulasan 
    // (Pastikan controller ini ada, jika error 'Target class not found', cek namespace-nya lagi)
    Route::resource('produk', ProdukController::class);
    Route::resource('diskon', DiskonController::class);
    Route::resource('ulasan', UlasanController::class);

    // 4. --- MANAJEMEN PESANAN ---
    // Lihat Daftar
    Route::get('/pesanan', [AdminController::class, 'indexPesanan'])->name('pesanan.index');
    
    // Lihat Detail
    Route::get('/pesanan/{id}', [AdminController::class, 'showPesanan'])->name('pesanan.show');
    
    // Update Status (ACC)
    Route::post('/pesanan/{id}/update', [AdminController::class, 'updateStatus'])->name('pesanan.update');
});