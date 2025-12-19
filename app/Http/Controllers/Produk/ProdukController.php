<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk (Katalog)
     */
    public function index(Request $request)
    {
        // 1. Ambil Query Dasar
        $query = Produk::with('kategori'); // Eager load kategori biar ringan

        // 2. Logika Filter Kategori (Jika ada ?kategori=KT001 di URL)
        if ($request->has('kategori') && $request->kategori != null) {
            $query->where('ID_Kategori', $request->kategori);
        }

        // 3. Logika Search (Opsional, jika ada search bar)
        if ($request->has('search')) {
            $query->where('Nama_Produk', 'like', '%' . $request->search . '%');
        }

        // 4. Ambil data dengan Pagination (12 produk per halaman)
        $products = $query->paginate(12)->withQueryString();

        // 5. Ambil daftar kategori untuk Sidebar Filter
        $categories = Kategori::all();

        return view('produk.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan Detail Satu Produk
     */
    public function show($id)
    {
        // Cari produk berdasarkan Custom ID (PRxxx)
        // Gunakan where karena findOrFail kadang default ke Integer
        $produk = Produk::where('ID_Produk', $id)->firstOrFail();
        
        // Ambil produk rekomendasi (acak 4 biji)
        $rekomendasi = Produk::inRandomOrder()->limit(4)->where('ID_Produk', '!=', $id)->get();

        return view('produk.show', compact('produk', 'rekomendasi'));
    }
}