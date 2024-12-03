<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'id',
        'id_user',
        'nim',
        'tmp_lahir',
        'tgl_lahir',
        'fakultas_id',
        'prodi_id',
        'kelas_id'
    ];

    protected $table = 'mahasiswa';
}
