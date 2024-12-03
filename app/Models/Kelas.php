<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'fakultas_id',
        'prodi_id',
        'tingkat',
    ];

    protected $table = 'kelas';
}
