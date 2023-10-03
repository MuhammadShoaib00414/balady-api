<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseQuestion extends Model
{
    public function CourseOptions()
    {
        return $this->hasMany(CourseAnswar::class, 'course_question_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
