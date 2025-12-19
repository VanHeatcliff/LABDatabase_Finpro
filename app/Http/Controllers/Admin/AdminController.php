<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Contoh logika dashboard sederhana
        return view('admin.dashboard.index'); 
    }

    // 1. Menampilkan Daftar Pesanan
    public function indexPesanan()
    {
        // Ambil pesanan terbaru, load relasi user agar nama muncul
        $pesanan = Pesanan::with('pelanggan')->orderBy('Tanggal_Pesan', 'desc')->get();
        
        // Arahkan ke folder admin/pesanan/index.blade.php
        return view('admin.pesanan.index', compact('pesanan'));
    }

    // 2. Menampilkan Detail Pesanan
    public function showPesanan($id)
    {
        $pesanan = Pesanan::with(['details.produk', 'pelanggan', 'metodeBayar'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    // 3. Update Status (Logika ACC)
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Ubah status sesuai input dari tombol
        $pesanan->Status_Pesanan = $request->status_baru;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}