<?php

namespace Database\Seeders;

use App\Models\ClassName;
use App\Models\Courses;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Role;
use App\Models\Rooms;
use App\Models\ScheduleByStudent;
use App\Models\Schedules;
use App\Models\Students;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'view dashboard', 'guard_name' => 'web']);
        Permission::create(['name' => 'view configuration', 'guard_name' => 'web']);
        Permission::create(['name' => 'view master data', 'guard_name' => 'web']);
        Permission::create(['name' => 'view akademik', 'guard_name' => 'web']);
        Permission::create(['name' => 'view apps', 'guard_name' => 'web']);

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $teacherRole = Role::create(['name' => 'teacher', 'guard_name' => 'web']);
        $studentRole = Role::create(['name' => 'student', 'guard_name' => 'web']);

        $adminRole->givePermissionTo('view dashboard');
        $adminRole->givePermissionTo('view configuration');
        $adminRole->givePermissionTo('view master data');

        $teacherRole->givePermissionTo('view dashboard');
        $teacherRole->givePermissionTo('view akademik');

        $studentRole->givePermissionTo('view apps');

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $adminUser->assignRole('admin');

        $teacherUser = User::create([
            'name' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $teacherUser->assignRole('teacher');

        $studentUser = User::create([
            'name' => 'Diki Muhamad Alfikri',
            'email' => 'diki@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $studentUser->assignRole('student');

        $studentUser2 = User::create([
            'name' => 'Ridho Makwa Nugraha',
            'email' => 'ridho@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $studentUser2->assignRole('student');

        $studentUser3 = User::create([
            'name' => 'Nita Silvy Alfany',
            'email' => 'nita@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'female'
        ]);
        $studentUser3->assignRole('student');

        $studentUser4 = User::create([
            'name' => 'Pina Sri Rahayu',
            'email' => 'pina@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'female'
        ]);
        $studentUser4->assignRole('student');

        Faculty::create([
            'name' => 'Fakultas Teknik Informasi',
            'initial' => 'FTI'
        ]);

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

        ClassName::create([
            'name' => 'IF III A',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'level' => 'III',
        ]);

        ClassName::create([
            'name' => 'IF III B',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'level' => 'III',
        ]);

        ClassName::create([
            'name' => 'SI III A',
            'faculty_id' => '1',
            'study_program_id' => '2',
            'level' => 'III',
        ]);

        ClassName::create([
            'name' => 'SI III B',
            'faculty_id' => '1',
            'study_program_id' => '2',
            'level' => 'III',
        ]);

        Students::create([
            'user_id' => $studentUser->id,
            'nim' => '230660121111',
            'pob' => 'Majalengka',
            'dob' => '2004/10/05',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'class_name_id' => '1',
        ]);

        Students::create([
            'user_id' => $studentUser2->id,
            'nim' => '230660121083',
            'pob' => 'Sumedang',
            'dob' => '2004/12/11',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'class_name_id' => '1',
        ]);

        Students::create([
            'user_id' => $studentUser3->id,
            'nim' => '230660121054',
            'pob' => 'Sumedang',
            'dob' => '2004/03/08',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'class_name_id' => '1',
        ]);

        Students::create([
            'user_id' => $studentUser4->id,
            'nim' => '230660121060',
            'pob' => 'Sumedang',
            'dob' => '2004/01/18',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'class_name_id' => '1',
        ]);

        Courses::create([
            'name' => 'Rekayasa Perangkat Lunak',
            'initial' => 'RPL',
            'faculty_id' => '1',
            'study_program_id' => '1',
        ]);

        Rooms::create([
            'name' => 'Ruangan 4',
            'room_location' => 'Gedung FTI'
        ]);

        Schedules::create([
            'course_id' => '1',
            'teacher_id' => '2',
            'room_id' => '1',
            'date' => '2024-12-07',
            'entry_time' => '20:00:00',
            'exit_time' => '23:00:00'
        ]);

        ScheduleByStudent::create([
            'course_id' => '1',
            'student_id' => '1',
            'schedule_id' => '1'
        ]);

    }
}
