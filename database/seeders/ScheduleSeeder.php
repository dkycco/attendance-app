<?php

namespace Database\Seeders;

use App\Models\StudentSchedule;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        Schedule::create([
            'course_id' => '1',
            'room_id' => '1',
            'semester_id' => '3',
            'day' => 'Monday',
            'entry_time' => '08:00',
            'exit_time' => '09:00'
        ]);

        StudentSchedule::create([
            'schedule_id' => '1',
            'student_id' => '1'
        ]);
    }
}
