<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';
    protected $guarded = ['id'];

    public function faculty() {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function study_program() {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }
}
