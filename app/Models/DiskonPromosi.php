<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiskonPromosi extends Model
{
    protected $table = 'diskon_promosi';
    protected $primaryKey = 'ID_Diskon';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_Diskon',
        'Kode_Diskon',
        'Persentase',
        'Tanggal_Berlaku',
        'Tanggal_Akhir',
        'Statues'
    ];
}
