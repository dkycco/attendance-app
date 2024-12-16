<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    protected $table = 'teacher_attendance';
    protected $guarded = ['id'];

    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
