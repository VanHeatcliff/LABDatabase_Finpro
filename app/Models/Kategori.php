<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;

    protected $fillable = ['id_kategori', 'nama_kategori'];
}
