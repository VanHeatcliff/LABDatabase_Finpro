<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'ID_Pesanan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_Pesanan',
        'ID_Pelanggan',
        'ID_Metode', 
        'Status_Pesanan',  
        'Tanggal_Pesan',   
        'ID_Alamat',     // Boleh ada (walau isinya NULL)
        'Alamat_Pengiriman', // <--- WAJIB DITAMBAHKAN (Agar teks alamat tersimpan)
        'ID_Diskon',       
        'Total_Harga'
    ];

    // Relasi ke Detail Pesanan
    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'ID_Pesanan', 'ID_Pesanan');
    }

    // Relasi ke Metode Bayar
    public function metodeBayar()
    {
        // Parameter: (Model Tujuan, FK di tabel Pesanan, PK di tabel MetodeBayar)
        return $this->belongsTo(MetodeBayar::class, 'ID_Metode', 'ID_Metode');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'ID_Pelanggan', 'ID_Pelanggan');
    }
}