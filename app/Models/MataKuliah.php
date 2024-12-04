<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $guarded = ['id'];

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
