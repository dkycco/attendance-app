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
        Schema::create('tacher_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('teacher_id')->constrained('users');
            $table->foreignId('semester_id')->constrained('semester');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'absentWreason']);
            $table->time('entry_time');
            $table->time('exit_time');
            $table->string('reason');
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('semester_id')->constrained('semester');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'absentWreason', 'sick']);
            $table->time('entry_time');
            $table->time('exit_time');
            $table->string('reason');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
