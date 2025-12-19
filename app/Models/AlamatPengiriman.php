<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    use HasFactory;

    protected $table = 'alamat_pengiriman';
    protected $primaryKey = 'ID_Alamat'; 
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_Alamat',
        'ID_Pelanggan',
        'Alamat_Lengkap',
        'Kota',
        'Kode_Pos'
    ];
}