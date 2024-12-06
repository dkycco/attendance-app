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
        $dosenRole = Role::create(['name' => 'dosen', 'guard_name' => 'web']);
        $mahasiswaRole = Role::create(['name' => 'mahasiswa', 'guard_name' => 'web']);

        $adminRole->givePermissionTo('view dashboard');
        $adminRole->givePermissionTo('view configuration');
        $adminRole->givePermissionTo('view master data');

        $dosenRole->givePermissionTo('view dashboard');
        $dosenRole->givePermissionTo('view akademik');

        $mahasiswaRole->givePermissionTo('view apps');

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
        ]);
        $adminUser->assignRole('admin');

        $dosenUser = User::create([
            'name' => 'Dosen User',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('admin1234'),
        ]);
        $dosenUser->assignRole('dosen');

        $mahasiswaUser = User::create([
            'name' => 'Mahasiswa User',
            'email' => 'mhs@gmail.com',
            'password' => bcrypt('admin1234')
        ]);
        $mahasiswaUser->assignRole('mahasiswa');

        $mahasiswaUser2 = User::create([
            'name' => 'Mahasiswa User 2',
            'email' => 'mhss@gmail.com',
            'password' => bcrypt('admin1234')
        ]);
        $mahasiswaUser2->assignRole('mahasiswa');

        Faculty::create([
            'name' => 'Fakultas Teknik Informasi',
            'initial' => 'FTI'
        ]);

        StudyProgram::create([
            'name' => 'Informatika',
            'initial' => 'IF'
        ]);

        ClassName::create([
            'name' => 'IF III A',
            'faculty_id' => '1',
            'study_program_id' => '1',
            'level' => 'I',
        ]);

        Students::create([
            'user_id' => $mahasiswaUser->id,
            'nim' => '32066012111',
            'pob' => 'Majalengka',
            'dob' => '2004/10/05',
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
