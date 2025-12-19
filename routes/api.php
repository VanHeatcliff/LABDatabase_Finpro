<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// API Controllers sesuai struktur folder
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Produk\KategoriController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Pesanan\PesananController;
use App\Http\Controllers\Pesanan\DetailPesananController;
use App\Http\Controllers\Ulasan\UlasanController;
use App\Http\Controllers\Diskon\DiskonController;
use App\Http\Controllers\Pembayaran\MetodeBayarController;
use App\Http\Controllers\Alamat\AlamatPengirimanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route di sini akan diakses dengan prefix /api
|
*/

// AUTH (API endpoints untuk register/login pelanggan & admin)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// PRODUK (API resource)
Route::apiResource('produk', ProdukController::class);

// KATEGORI (hanya index + store sesuai kebutuhan)
Route::apiResource('kategori', KategoriController::class)->only(['index', 'store']);

// PELANGGAN (ambil daftar pelanggan — jika perlu)
Route::get('/pelanggan', [PelangganController::class, 'index']);

// PESANAN
Route::post('/pesanan', [PesananController::class, 'store']);
Route::get('/pesanan', [PesananController::class, 'index']);
Route::post('/pesanan/{id}/bayar', [PesananController::class, 'bayar']);
Route::post('/pesanan/{id}/verifikasi', [PesananController::class, 'verifikasi']);

// DETAIL PESANAN
Route::get('/detail-pesanan', [DetailPesananController::class, 'index']);

// ULASAN
Route::post('/ulasan', [UlasanController::class, 'store']);
Route::get('/ulasan', [UlasanController::class, 'index']);

// DISKON
Route::apiResource('diskon', DiskonController::class)->only(['index', 'store']);

// METODE BAYAR
Route::apiResource('metode-bayar', MetodeBayarController::class)->only(['index', 'store']);

// ALAMAT PENGIRIMAN
Route::post('/alamat', [AlamatPengirimanController::class, 'store']);

// TEST API
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API OK & Backend berjalan!',
        'time' => now()->toDateTimeString()
    ]);
});

Route::get('/test-db', function () {
    try {
        $adminCount = DB::table('admin')->count();

        return response()->json([
            'status' => 'success',
            'database' => 'connected',
            'admin_total' => $adminCount
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
