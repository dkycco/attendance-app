<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'singkat'
    ];

    protected $table = 'prodi';
}
