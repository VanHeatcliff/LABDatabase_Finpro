<?php

namespace App\Services;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Helpers\IDGenerator;

class PesananService
{
    public function buatPesanan($pelangganId, $items, $alamatId)
    {
        $idPesanan = IDGenerator::generate('pesanan', 'id_pesanan', 'PS');

        $pesanan = Pesanan::create([
            'id_pesanan' => $idPesanan,
            'pelanggan_id' => $pelangganId,
            'alamat_id' => $alamatId,
            'status' => 'menunggu_pembayaran'
        ]);

        foreach ($items as $item) {
            DetailPesanan::create([
                'id_detail' => IDGenerator::generate('detail_pesanan', 'id_detail', 'DP'),
                'pesanan_id' => $idPesanan,
                'produk_id' => $item['produk_id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return $pesanan;
    }
}
