<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = ['id'];

    protected $with = ['fakultas', 'prodi'];

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
