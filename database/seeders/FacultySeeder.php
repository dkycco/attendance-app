<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        Faculty::create([
            'name' => 'Fakultas Teknik Informasi',
            'initial' => 'FTI'
        ]);
    }
}
