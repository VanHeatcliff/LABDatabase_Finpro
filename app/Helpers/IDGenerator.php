<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class IDGenerator
{
    public static function generate($table, $field, $prefix, $pad_length = 3)
    {
        // Ambil data terakhir berdasarkan ID (descending)
        $data = DB::table($table)->orderBy($field, 'desc')->first();

        if (!$data) {
            // Jika tabel kosong, mulai dari 001
            return $prefix . str_pad(1, $pad_length, "0", STR_PAD_LEFT);
        }

        // Ambil ID terakhir, misal: KR005
        $lastCode = $data->$field;
        
        // Ambil angka saja (hapus prefix), misal: 005
        $lastNumber = (int) substr($lastCode, strlen($prefix));
        
        // Tambah 1
        $nextNumber = $lastNumber + 1;
        
        // Gabungkan kembali
        return $prefix . str_pad($nextNumber, $pad_length, "0", STR_PAD_LEFT);
    }
}