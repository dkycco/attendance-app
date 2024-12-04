<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $guarded = ['id'];

    protected $with = ['user', 'fakultas', 'prodi', 'kelas'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
