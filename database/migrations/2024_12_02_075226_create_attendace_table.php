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
        Schema::create('teacher_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users');
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'absentWreason']);
            $table->time('entry_time');
            $table->time('exit_time')->nullable();
            $table->string('reason')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'absentWreason', 'sick']);
            $table->time('entry_time');
            $table->time('exit_time')->nullable();
            $table->string('reason')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendance');
        Schema::dropIfExists('attendance');
    }
};
