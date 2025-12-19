<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Helpers\IDGenerator;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return Kategori::all();
    }

    public function store(Request $req)
    {
        $id = IDGenerator::generate('kategori_produk', 'id_kategori', 'KT');

        return Kategori::create([
            'id_kategori' => $id,
            'nama_kategori' => $req->nama_kategori
        ]);
    }
}
