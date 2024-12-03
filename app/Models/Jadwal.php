<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'id',
        'mata_kuliah_id',
        'dosen_id',
        'mahasiswa_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'waktu_masuk_aktual',
        'waktu_keluar_aktual',
        'qr_code'
    ];

    protected $table = 'jadwal';
}
