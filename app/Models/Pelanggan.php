<?php

namespace App\Models;

// 1. Ganti 'Model' biasa dengan 'Authenticatable'
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'ID_Pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Sesuaikan jika ada/tidak ada created_at

    protected $fillable = [
        'ID_Pelanggan', 'Nama', 'Email', 'Telepon', 'Password'
    ];

    // 2. Sembunyikan password agar aman
    protected $hidden = ['Password'];

    // 3. Beri tahu Laravel kalau kolom password kamu namanya 'Password' (bukan 'password')
    public function getAuthPassword()
    {
        return $this->Password;
    }
}