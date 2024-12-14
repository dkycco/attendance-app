<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $admin->assignRole('admin');

        $teacher = User::create([
            'name' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $teacher->assignRole('teacher');
    }
}
