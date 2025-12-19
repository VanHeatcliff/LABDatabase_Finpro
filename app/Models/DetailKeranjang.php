<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    protected $table = 'detail_keranjang';
    protected $primaryKey = 'ID_DetailKeranjang';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'ID_DetailKeranjang',
        'ID_keranjang',
        'ID_Produk',
        'jumlah'
    ];

    public function keranjang()
    {
        return $this->belongsTo(
            Keranjang::class,
            'ID_Keranjang', // FK di detail_keranjang
            'ID_Keranjang'  // PK di keranjang
        );
    }

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'ID_Produk',
            'ID_Produk'
        );
    }
}
