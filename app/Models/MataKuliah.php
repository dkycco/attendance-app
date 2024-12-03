<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'singkat',
        'tahun_akademik',
        'photo'
    ];

    protected $table = 'mata_kuliah';
}
