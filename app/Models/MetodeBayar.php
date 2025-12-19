<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    protected $table = 'metode_bayar';
    protected $primaryKey = 'id_metode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_metode',
        'nama_metode'
    ];
}
