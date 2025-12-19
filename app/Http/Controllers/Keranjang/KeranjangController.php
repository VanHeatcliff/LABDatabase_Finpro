<?php

namespace App\Http\Controllers\Keranjang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use App\Helpers\IDGenerator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KeranjangController extends Controller
{
    public function index()
    {
        $idPelanggan = Auth::user()->ID_Pelanggan; // Pastikan Auth login pakai Guard Pelanggan

        // Cari keranjang milik user ini
        $keranjang = Keranjang::with(['details.produk'])
                    ->where('ID_Pelanggan', $idPelanggan)
                    ->first();

        return view('keranjang.index', compact('keranjang'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,ID_Produk',
            'qty' => 'integer|min:1' 
        ]);

        $idPelanggan = Auth::user()->ID_Pelanggan;
        $qty = $request->qty ?? 1;

        // 1. Cek atau Buat Header Keranjang (KRxxx)
        $keranjang = Keranjang::where('ID_Pelanggan', $idPelanggan)->first();

        if (!$keranjang) {
            $idKeranjang = IDGenerator::generate('keranjang', 'ID_Keranjang', 'KR');
            
            $keranjang = Keranjang::create([
                'ID_Keranjang' => $idKeranjang,
                'ID_Pelanggan' => $idPelanggan,
                'TglUpdate' => Carbon::now()
            ]);
        } else {
            // Update timestamp
            $keranjang->update(['TglUpdate' => Carbon::now()]);
        }

        // 2. Cek Detail Item (DKxxx)
        // Cek apakah produk ini sudah ada di keranjang tersebut?
        $detail = DetailKeranjang::where('ID_keranjang', $keranjang->ID_Keranjang)
                ->where('ID_Produk', $request->id_produk)
                ->first();

    if ($detail) {
        // Jika sudah ada, tambah jumlahnya
        // UPDATE: Gunakan 'jumlah' (kecil)
        $detail->jumlah += $qty;
        $detail->save();
    } else {
        // Jika belum ada, buat baris detail baru
        $idDetail = IDGenerator::generate('detail_keranjang', 'ID_DetailKeranjang', 'DK');

        DetailKeranjang::create([
            'ID_DetailKeranjang' => $idDetail,
            
            // PERBAIKAN DISINI: Gunakan key sesuai $fillable (Huruf Kecil)
            'ID_keranjang' => $keranjang->ID_Keranjang, 
            'ID_Produk' => $request->id_produk,
            'jumlah' => $qty 
        ]);
    }

    return redirect()->back()->with('success', 'Produk berhasil masuk keranjang!');
    }

    public function destroy($idDetail)
    {
        $detail = DetailKeranjang::findOrFail($idDetail);
        $detail->delete();

        return redirect()->back()->with('success', 'Item dihapus.');
    }
}