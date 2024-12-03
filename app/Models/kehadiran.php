<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kehadiran extends Model
{
    protected $fillable = [
        'id',
        'mata_kuliah_id',
        'mahasiswa_id',
        'status',
        'waktu_masuk_aktual',
        'waktu_keluar_aktual',
        'alasan_singkat',
        'file'
    ];

    protected $table = 'kelas';
}
