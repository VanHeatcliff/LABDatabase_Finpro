<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        return Pelanggan::all();
    }

    public function show($id)
    {
        return Pelanggan::findOrFail($id);
    }
}
