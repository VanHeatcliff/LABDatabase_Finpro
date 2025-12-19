<?php

namespace App\Services;

use App\Models\Produk;
use App\Helpers\IDGenerator;

class ProdukService
{
    public function buatProduk($data)
    {
        $data['id_produk'] = IDGenerator::generate('produk', 'id_produk', 'PR');

        return Produk::create($data);
    }

    public function updateProduk($produk, $data)
    {
        return $produk->update($data);
    }

    public function hapusProduk($produk)
    {
        return $produk->delete();
    }
}
