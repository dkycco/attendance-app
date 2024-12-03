<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah');
            $table->foreignId('dosen_id')->constrained('users');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa');
            $table->date('tanggal');
            $table->time('waktu_masuk');
            $table->time('waktu_keluar');
            $table->time('waktu_masuk_aktual');
            $table->time('waktu_keluar_aktual');
            $table->string('qr_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
