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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa');
            $table->enum('status', ['h', 'i', 's', 'a']);
            $table->date('tanggal');
            $table->time('waktu_masuk_aktual');
            $table->time('waktu_keluar_aktual');
            $table->string('alasan_singkat');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
