<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'course_code' => 'A03423498',
            'name' => 'Rekayasa Perangkat Lunak',
            'initial' => 'RPL',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'teacher_id' => '2'
        ]);
    }
}
