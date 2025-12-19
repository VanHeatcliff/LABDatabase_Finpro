<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    
    // SESUAI GAMBAR DB KAMU:
    protected $primaryKey = 'ID_Detail'; // Bukan ID_DetailPesanan
    
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_Detail',     // <--- Primary Key
        'ID_Pesanan',
        'ID_Produk',
        'Jumlah',        // Huruf 'J' Besar
        'Harga_Satuan'   // <--- Bukan 'Subtotal', tapi 'Harga_Satuan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ID_Produk', 'ID_Produk');
    }
}