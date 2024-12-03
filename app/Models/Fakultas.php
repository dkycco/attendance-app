<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'singkat'
    ];

    protected $table = 'fakultas';
}
