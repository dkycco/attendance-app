<?php

namespace Database\Seeders;

use App\Models\ClassName;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class ClassNameSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $faculties = Faculty::all();
        $studyPrograms = StudyProgram::all();
        $semesters = Semester::all();
        $alphabets = ['A', 'B', 'C'];

        foreach ($faculties as $faculty) {
            foreach ($studyPrograms as $studyProgram) {
                foreach ($semesters as $semester) {
                    foreach ($alphabets as $alphabet) {
                        $data[] = [
                            'name' => "$studyProgram->initial $semester->name $alphabet",
                            'faculty_id' => $faculty->id,
                            'study_program_id' => $studyProgram->id,
                            'semester_id' => $semester->id,
                        ];
                    }
                }
            }
        }

        ClassName::insert($data);
    }
}
