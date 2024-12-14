<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];
    protected $table = 'schedules';

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
