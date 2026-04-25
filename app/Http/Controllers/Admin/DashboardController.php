<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import Model agar bisa hitung data
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Pelanggan; // atau User, sesuaikan model pelanggan kamu
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // INI FUNCTION YANG HILANG (index)
    public function index()
    {
        // 1. Hitung-hitungan untuk Kartu Dashboard
        $totalPesanan = Pesanan::count();
        
        // Hitung pesanan yang perlu diproses (Status: Menunggu Verifikasi / Diproses)
        $pesananPerluProses = Pesanan::whereIn('Status_Pesanan', ['Menunggu Verifikasi', 'Diproses'])->count();
        
        $totalProduk = Produk::count();
        
        // Hitung Pendapatan (Total Harga dari pesanan yang 'Selesai' atau 'Dikirim')
        $pendapatan = Pesanan::whereIn('Status_Pesanan', ['Selesai', 'Dikirim'])->sum('Total_Harga');

        // Data Grafik Penjualan 7 Hari Terakhir
        $chartData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            
            // Sertakan juga pesanan yang mungkin sudah dibayar
            $totalSales = Pesanan::whereIn('Status_Pesanan', ['Selesai', 'Dikirim', 'Diproses', 'Menunggu Verifikasi'])
                                 ->whereDate('Tanggal_Pesan', $date)
                                 ->sum('Total_Harga');
            $chartData[] = $totalSales;
        }

        // 2. Kirim data ke View
        // Pastikan kamu punya file: resources/views/admin/dashboard/index.blade.php
        return view('admin.dashboard.index', compact(
            'totalPesanan', 
            'pesananPerluProses', 
            'totalProduk', 
            'pendapatan',
            'chartLabels',
            'chartData'
        ));
    }
}