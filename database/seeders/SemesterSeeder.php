<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $semesters = [
            1 => ['start_date' => '2000-09-16', 'end_date' => '2001-01-04'],
            2 => ['start_date' => '2001-03-03', 'end_date' => '2001-07-05'],
        ];

        function toRoman($number): string {
            $map = [
                'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
                'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
                'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
            ];
            $result = '';
            foreach ($map as $roman => $value) {
                while ($number >= $value) {
                    $result .= $roman;
                    $number -= $value;
                }
            }
            return $result;
        }

        for ($i = 1; $i <= 7; $i++) {
            Semester::create([
                'name' => toRoman($i),
                'odd_even' => $i % 2 === 1 ? 'odd' : 'even',
                'start_date' => $semesters[$i % 2 === 1 ? 1 : 2]['start_date'],
                'end_date' => $semesters[$i % 2 === 1 ? 1 : 2]['end_date'],
            ]);
        }
    }

}
