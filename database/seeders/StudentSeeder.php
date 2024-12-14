<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::create([
            'name' => 'Diki Muhamad Alfikri',
            'email' => 'diki@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $student->assignRole('student');

        $student2 = User::create([
            'name' => 'Ridho Makwa Nugraha',
            'email' => 'ridho@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $student2->assignRole('student');

        $student3 = User::create([
            'name' => 'Nita Silvy Alfany',
            'email' => 'nita@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'female'
        ]);
        $student3->assignRole('student');

        $student4 = User::create([
            'name' => 'Pina Sri Rahayu',
            'email' => 'pina@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'female'
        ]);
        $student4->assignRole('student');

        Student::create([
            'user_id' => $student->id,
            'nim' => '230660121111',
            'pob' => 'Majalengka',
            'dob' => '2004/10/05',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'semester_id' => '3',
            'class_name_id' => '7',
        ]);

        Student::create([
            'user_id' => $student2->id,
            'nim' => '230660121083',
            'pob' => 'Sumedang',
            'dob' => '2004/12/11',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'semester_id' => '3',
            'class_name_id' => '7',
        ]);

        Student::create([
            'user_id' => $student3->id,
            'nim' => '230660121054',
            'pob' => 'Sumedang',
            'dob' => '2004/03/08',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'semester_id' => '3',
            'class_name_id' => '7',
        ]);

        Student::create([
            'user_id' => $student4->id,
            'nim' => '230660121060',
            'pob' => 'Sumedang',
            'dob' => '2004/01/18',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'semester_id' => '3',
            'class_name_id' => '7',
        ]);
    }
}
