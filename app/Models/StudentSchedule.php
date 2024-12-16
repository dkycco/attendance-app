<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $table = 'student_schedules';
    protected $guarded = ['id'];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
