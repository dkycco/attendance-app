<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function faculty() {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function study_program() {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }

    public function class_name() {
        return $this->belongsTo(ClassName::class, 'class_name_id');
    }
}
