<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\IDGenerator;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\DetailKeranjang;
use App\Models\AlamatPengiriman; // <--- WAJIB IMPORT MODEL INI
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        $keranjang = Keranjang::where('ID_Pelanggan', $user->ID_Pelanggan)->first();

        // Pastikan view mengarah ke folder yang benar
        return view('pesanan.checkout', compact('keranjang'));
    }

    public function process(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'alamat_lengkap' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $user = Auth::guard('pelanggan')->user();
        $keranjang = Keranjang::where('ID_Pelanggan', $user->ID_Pelanggan)->first();

        if (!$keranjang || $keranjang->details->isEmpty()) {
            return redirect()->route('home')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();

        try {
            // ------------------------------------------------------------------
            // LANGKAH 1: SIMPAN ALAMAT PENGIRIMAN DULU
            // ------------------------------------------------------------------
            $idAlamat = IDGenerator::generate('alamat_pengiriman', 'ID_Alamat', 'AL', 5);

            AlamatPengiriman::create([
                'ID_Alamat' => $idAlamat,
                'ID_Pelanggan' => $user->ID_Pelanggan,
                'Alamat_Lengkap' => $request->alamat_lengkap,
                'Kota' => $request->kota,
                'Kode_Pos' => $request->kode_pos
            ]);

            // ------------------------------------------------------------------
            // LANGKAH 2: HITUNG TOTAL BAYAR
            // ------------------------------------------------------------------
            $totalBayar = 0;
            foreach ($keranjang->details as $detail) {
                // Gunakan 'jumlah' (huruf kecil) dari keranjang
                $totalBayar += $detail->produk->Harga * $detail->jumlah; 
            }

            // ------------------------------------------------------------------
            // LANGKAH 3: SIMPAN HEADER PESANAN (UPDATE DISINI)
            // ------------------------------------------------------------------
            $idPesanan = IDGenerator::generate('pesanan', 'ID_Pesanan', 'PS', 5);

            Pesanan::create([
                'ID_Pesanan' => $idPesanan,
                'ID_Pelanggan' => $user->ID_Pelanggan,
                
                // GANTI: 'Tgl_Pesanan' jadi 'Tanggal_Pesan'
                'Tanggal_Pesan' => Carbon::now(),
                
                'Total_Harga' => $totalBayar,
                
                // GANTI: 'Status' jadi 'Status_Pesanan'
                'Status_Pesanan' => 'Menunggu Pembayaran',
                
                'ID_Alamat' => $idAlamat,
                
                // TAMBAHAN: Set ID_Diskon null (karena belum ada fitur diskon di checkout)
                'ID_Diskon' => null 
            ]);

            // ------------------------------------------------------------------
            // LANGKAH 4: PINDAHKAN ITEM KERANJANG KE DETAIL PESANAN
            // ------------------------------------------------------------------
            foreach ($keranjang->details as $detail) {
                
                // Generate ID Detail (DPxxxxx)
                $idDetail = IDGenerator::generate('detail_pesanan', 'ID_Detail', 'DP', 5);
                
                DetailPesanan::create([
                    'ID_Detail' => $idDetail,           // Sesuai screenshot kamu
                    'ID_Pesanan' => $idPesanan,
                    'ID_Produk' => $detail->ID_Produk,
                    'Jumlah' => $detail->jumlah,        // Masuk ke kolom 'Jumlah'
                    'Harga_Satuan' => $detail->produk->Harga // Sesuai screenshot kamu
                ]);
            }

            // ------------------------------------------------------------------
            // LANGKAH 5: BERSIHKAN KERANJANG
            // ------------------------------------------------------------------
            DetailKeranjang::where('ID_Keranjang', $keranjang->ID_Keranjang)->delete();
            $keranjang->delete();

            DB::commit();

            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            // Tampilkan error di layar (debug)
            dd($e->getMessage());
        }
    }
}