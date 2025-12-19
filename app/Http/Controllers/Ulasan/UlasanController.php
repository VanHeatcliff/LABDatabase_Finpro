<?php

namespace App\Http\Controllers\Ulasan;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Helpers\IDGenerator;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $req)
    {
        $id = IDGenerator::generate('ulasan_produk', 'id_ulasan', 'UP');

        return Ulasan::create([
            'id_ulasan' => $id,
            'id_pelanggan' => $req->id_pelanggan,
            'id_produk' => $req->id_produk,
            'rating' => $req->rating,
            'komentar' => $req->komentar
        ]);
    }

    public function index()
    {
        return Ulasan::with(['produk', 'pelanggan'])->get();
    }
}
