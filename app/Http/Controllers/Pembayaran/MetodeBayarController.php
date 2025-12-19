<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\MetodeBayar;
use App\Helpers\IDGenerator;
use Illuminate\Http\Request;

class MetodeBayarController extends Controller
{
    public function index()
    {
        return MetodeBayar::all();
    }

    public function store(Request $req)
    {
        $id = IDGenerator::generate('metode_bayar', 'id_metode', 'MT');

        return MetodeBayar::create([
            'id_metode' => $id,
            'nama_metode' => $req->nama_metode
        ]);
    }
}
