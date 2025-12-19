<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskon';
    protected $primaryKey = 'id_diskon';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_diskon',
        'produk_id',
        'persen',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }
}
