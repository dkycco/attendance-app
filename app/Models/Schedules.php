<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $guarded = ['id'];
    protected $table = 'schedules';

    public function course() {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function room() {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
