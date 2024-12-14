<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionRoleSeeder::class,
            UserSeeder::class,
            FacultySeeder::class,
            StudyProgramSeeder::class,
            SemesterSeeder::class,
            ClassNameSeeder::class,
            RoomSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            ScheduleSeeder::class
        ]);
    }
}
