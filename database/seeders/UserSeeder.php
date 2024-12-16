<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Beben Sutara, S.Kom., M.T',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'male'
        ]);
        $admin->assignRole('admin');

        $teacher = User::create([
            'name' => 'Hj. Maya Suhayati, M.Kom',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('admin1234'),
            'gender' => 'female'
        ]);
        $teacher->assignRole('teacher');
    }
}
