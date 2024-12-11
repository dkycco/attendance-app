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
        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('initial');
            $table->timestamps();
        });

        Schema::create('study_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained('faculty');
            $table->string('name');
            $table->string('initial');
            $table->timestamps();
        });

        Schema::create('class_name', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('faculty_id')->constrained('faculty');
            $table->foreignId('study_program_id')->constrained('study_program');
            $table->string('level');
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('nim')->unique();
            $table->string('pob');
            $table->date('dob');
            $table->foreignId('faculty_id')->constrained('faculty');
            $table->foreignId('study_program_id')->constrained('study_program');
            $table->foreignId('class_name_id')->constrained('class_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty');
        Schema::dropIfExists('study_program');
        Schema::dropIfExists('class_name');
        Schema::dropIfExists('students');
    }
};
