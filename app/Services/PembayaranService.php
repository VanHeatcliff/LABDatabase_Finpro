<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Helpers\IDGenerator;

class PembayaranService
{
    public function prosesPembayaran($pesananId, $jumlah, $metode)
    {
        return Pembayaran::create([
            'id_bayar' => IDGenerator::generate('pembayaran', 'id_bayar', 'BY'),
            'pesanan_id' => $pesananId,
            'jumlah' => $jumlah,
            'metode' => $metode,
            'status' => 'dibayar'   // simulasi user berhasil bayar
        ]);
    }
}
