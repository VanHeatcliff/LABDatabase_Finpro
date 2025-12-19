<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    
    // 1. Definisikan Primary Key Custom
    protected $primaryKey = 'ID_Admin'; 
    public $incrementing = false;     // Karena ID kamu 'AD001' (bukan angka urut)
    protected $keyType = 'string';    // Karena ID kamu string

    public $timestamps = false;       // Di foto tabel tidak terlihat kolom created_at/updated_at

    protected $fillable = [
        'ID_Admin', 
        'Nama_Admin', 
        'Email', 
        'Password',
        'Role_Admin'
    ];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    // 2. Override Password (PENTING!)
    // Ini memberi tahu Laravel: "Password saya disimpan di kolom 'Password', bukan 'password'"
    public function getAuthPassword()
    {
        return $this->Password;
    }
}