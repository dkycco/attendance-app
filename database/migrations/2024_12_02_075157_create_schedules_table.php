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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_location');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('semester_id')->constrained('semester');
            $table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $table->time('entry_time');
            $table->time('exit_time');
            $table->timestamps();
        });

        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules');;
            $table->foreignId('student_id')->constrained('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('student_schedules');
    }
};
