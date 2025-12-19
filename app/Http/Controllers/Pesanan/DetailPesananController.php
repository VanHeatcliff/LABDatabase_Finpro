<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;

class DetailPesananController extends Controller
{
    public function index()
    {
        return DetailPesanan::all();
    }
}
