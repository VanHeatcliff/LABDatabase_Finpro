<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Sesuai nama tabel
    protected $primaryKey = 'ID_Pembayaran';
    
    public $incrementing = false; // Karena kita pakai ID String (PAY-...)
    protected $keyType = 'string';
    public $timestamps = false; // Karena di gambar tidak ada created_at/updated_at

    protected $fillable = [
        'ID_Pembayaran',
        'ID_Pesanan',
        'ID_Metode',
        'Jumlah_Bayar',
        'Tanggal_Bayar'
    ];

    // Relasi balik ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'ID_Pesanan', 'ID_Pesanan');
    }
}