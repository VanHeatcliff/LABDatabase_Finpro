<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->paginate(10);
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Produk' => 'required',
            'ID_Kategori' => 'required',
            'Harga' => 'required|numeric',
            'Stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $lastProduk = Produk::orderBy('ID_Produk', 'desc')->first();
        if ($lastProduk) {
            $lastId = intval(substr($lastProduk->ID_Produk, 2));
            $newId = 'PR' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'PR001';
        }

        $gambarPath = '';
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/produk'), $filename);
            $gambarPath = 'assets/images/produk/' . $filename;
        }

        $produk = new Produk();
        $produk->ID_Produk = $newId;
        $produk->Nama_Produk = $request->Nama_Produk;
        $produk->ID_Kategori = $request->ID_Kategori;
        $produk->Harga = $request->Harga;
        $produk->Stok = $request->Stok;
        $produk->ID_Admin = auth('admin')->id() ?? 'AD001'; // Default admin
        $produk->gambar_url = $gambarPath;
        // Check if Deskripsi column exists or we need to add it to DB. For now, it's missing in DB based on Schema::getColumnListing.
        $produk->save();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }
}
