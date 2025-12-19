<?php

namespace App\Http\Controllers\Alamat;

use App\Http\Controllers\Controller;
use App\Models\AlamatPengiriman;
use App\Helpers\IDGenerator;
use Illuminate\Http\Request;

class AlamatPengirimanController extends Controller
{
    public function store(Request $req)
    {
        $id = IDGenerator::generate('alamat_pengiriman', 'id_alamat', 'AL');

        return AlamatPengiriman::create([
            'id_alamat' => $id,
            'id_pelanggan' => $req->id_pelanggan,
            'alamat' => $req->alamat
        ]);
    }
}
