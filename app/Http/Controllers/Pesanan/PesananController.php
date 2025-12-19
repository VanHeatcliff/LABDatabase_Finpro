<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\MetodeBayar;
use App\Models\Keranjang;
use App\Models\Pembayaran;

class PesananController extends Controller
{
    public function index()
    {
        $idPelanggan = Auth::user()->ID_Pelanggan;
        $pesanan = Pesanan::where('ID_Pelanggan', $idPelanggan)->orderBy('Tanggal_Pesan', 'desc')->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $metodeBayar = MetodeBayar::all();
        $idPelanggan = Auth::user()->ID_Pelanggan;
        // Pastikan load relasi produk agar harga terbaca
        $keranjang = Keranjang::with('details.produk')->where('ID_Pelanggan', $idPelanggan)->first();

        if(!$keranjang || $keranjang->details->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang belanja kosong!');
        }
        return view('pesanan.checkout', compact('metodeBayar', 'keranjang'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'alamat_pengiriman' => 'required',
            'total_harga'       => 'required|numeric',
            'ID_Metode'         => 'required|exists:metode_bayar,ID_Metode',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            
            // 2. Ambil Keranjang
            $keranjang = Keranjang::with('details.produk')->where('ID_Pelanggan', $user->ID_Pelanggan)->first();
            
            if (!$keranjang) {
                return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
            }

            // 3. Simpan HEADER Pesanan
            $pesanan = new Pesanan();
            
            // --- GENERATE ID PESANAN (PS001...) ---
            $lastPesanan = Pesanan::orderBy('ID_Pesanan', 'desc')->first();
            if (!$lastPesanan) {
                $pesanan->ID_Pesanan = 'PS001';
            } else {
                $lastID = $lastPesanan->ID_Pesanan;
                $number = (int) substr($lastID, 2); 
                $pesanan->ID_Pesanan = 'PS' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
            }

            $pesanan->ID_Pelanggan   = $user->ID_Pelanggan;
            $pesanan->ID_Metode      = $request->ID_Metode; 
            $pesanan->Tanggal_Pesan  = now();
            $pesanan->Status_Pesanan = 'Diproses'; 
            $pesanan->Total_Harga    = $request->total_harga;
            
            // --- PERBAIKAN ALAMAT PENGIRIMAN ---
            // Pastikan di tabel `pesanan` ada kolom `Alamat_Pengiriman`
            // Jika nama kolom di DB kamu `Alamat_Lengkap`, ganti bagian ini.
            $pesanan->Alamat_Pengiriman = $request->alamat_pengiriman; 
            
            $pesanan->save();

            // 4. Simpan DETAIL Pesanan
            
            // --- LOGIKA GENERATE ID DETAIL (DP001...) ---
            $lastDetail = DetailPesanan::orderBy('ID_Detail', 'desc')->first();
            $nextNumber = 1; 

            if ($lastDetail) {
                $nextNumber = (int) substr($lastDetail->ID_Detail, 2) + 1;
            }

            foreach ($keranjang->details as $item) {
                $detail = new DetailPesanan();
                
                $detail->ID_Detail    = 'DP' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                $nextNumber++; 
                
                $detail->ID_Pesanan   = $pesanan->ID_Pesanan;
                $detail->ID_Produk    = $item->ID_Produk;
                
                // --- PERBAIKAN QTY ---
                // $item->jumlah (huruf kecil) dari Model Keranjang/Blade
                // $detail->Jumlah (huruf besar) untuk kolom DB DetailPesanan
                $detail->Jumlah       = $item->jumlah; 
                
                $detail->Harga_Satuan = $item->produk->Harga; 
                
                $detail->save();
            }

            // 5. Hapus Isi Keranjang
            DB::table('detail_keranjang')->where('ID_Keranjang', $keranjang->ID_Keranjang)->delete();

            DB::commit(); 

            // 6. Redirect ke halaman Success
            return view('pesanan.success', compact('pesanan'));

        } catch (\Exception $e) {
            DB::rollback(); 
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function konfirmasiPembayaran(Request $request, $idPesanan)
    {
        $user = Auth::user();
        
        $pesanan = Pesanan::where('ID_Pesanan', $idPesanan)
                          ->where('ID_Pelanggan', $user->ID_Pelanggan)
                          ->firstOrFail();

        $cekBayar = Pembayaran::where('ID_Pesanan', $idPesanan)->first();
        if ($cekBayar) {
            return redirect()->back()->with('error', 'Pesanan ini sudah dikonfirmasi pembayarannya.');
        }

        DB::beginTransaction();
        try {
            $pembayaran = new Pembayaran();
            
            $lastBayar = Pembayaran::orderBy('ID_Pembayaran', 'desc')->first();
            if (!$lastBayar) {
                $pembayaran->ID_Pembayaran = 'PY001';
            } else {
                $lastID = $lastBayar->ID_Pembayaran;
                $number = (int) substr($lastID, 2); 
                $pembayaran->ID_Pembayaran = 'PY' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
            }
            
            $pembayaran->ID_Pesanan    = $pesanan->ID_Pesanan;
            $pembayaran->ID_Metode     = $pesanan->ID_Metode; 
            $pembayaran->Jumlah_Bayar  = $pesanan->Total_Harga;
            $pembayaran->Tanggal_Bayar = now(); 
            
            $pembayaran->save();

            $pesanan->Status_Pesanan = 'Menunggu Verifikasi';
            $pesanan->save();

            DB::commit();

            return redirect()->back()->with('success', 'Terima kasih! Pembayaran sedang diverifikasi.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal konfirmasi: ' . $e->getMessage());
        }
    }
    
    public function show($id) {
        $pesanan = Pesanan::with(['details.produk', 'metodeBayar'])->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }
}