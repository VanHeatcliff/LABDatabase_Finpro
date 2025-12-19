<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    // 1. Nama Tabel (sesuai database)
    protected $table = 'keranjang';

    // 2. Primary Key Custom (KRxxx)
    protected $primaryKey = 'ID_Keranjang';

    // 3. Matikan Auto Increment (Wajib untuk custom ID string)
    public $incrementing = false;

    // 4. Tipe Data Primary Key
    protected $keyType = 'string';

    // 5. Matikan timestamp bawaan Laravel (created_at, updated_at) 
    // jika di tabel kamu hanya ada 'TglUpdate'
    public $timestamps = false;

    // Kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'ID_Keranjang',
        'ID_Pelanggan',
        'TglUpdate'
    ];

    // --- RELASI (Eloquent Relationships) ---

    /**
     * Relasi ke Detail Keranjang (One to Many)
     * Satu Keranjang punya banyak item produk (Detail)
     */
    public function details()
    {
        // hasMany(ModelTujuan, Foreign_Key_Di_Tabel_Tujuan, Local_Key_Di_Sini)
        return $this->hasMany(DetailKeranjang::class, 'ID_keranjang', 'ID_Keranjang');
    }

    /**
     * Relasi ke Pelanggan (Many to One)
     * Keranjang ini milik satu pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'ID_Pelanggan', 'ID_Pelanggan');
    }
}