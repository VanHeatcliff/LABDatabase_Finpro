<?php

namespace App\Http\Controllers\Diskon;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Helpers\IDGenerator;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        return Diskon::all();
    }

    public function store(Request $req)
    {
        $id = IDGenerator::generate('diskon_promosi', 'id_diskon', 'DS');

        return Diskon::create([
            'id_diskon' => $id,
            'nama_diskon' => $req->nama_diskon,
            'persen_diskon' => $req->persen_diskon
        ]);
    }
}
