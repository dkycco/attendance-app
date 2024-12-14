<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    public function run(): void
    {
        StudyProgram::create([
            'faculty_id' => '1',
            'name' => 'Informatika',
            'initial' => 'IF'
        ]);

        StudyProgram::create([
            'faculty_id' => '1',
            'name' => 'Sistem Informasi',
            'initial' => 'SI'
        ]);
    }
}
