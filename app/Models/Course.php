<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    use HasFactory;


    /**
     * Get the user that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'course_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function media()
    {
        return $this->hasOne(CourseMedia::class, 'course_id');
    }

    public function outcome()
    {
        return $this->hasOne(CourseOutcome::class, 'course_id');
    }

    public function requirements()
    {
        return $this->hasMany(CourseRequirement::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class,'course_id');
    }

    public function courseQuestion()
    {
        return $this->hasMany(CourseQuestion::class, 'course_id');
    }

    public function CourseComplete()
    {
        return $this->hasMany(CourseComplete::class, 'course_id');
    }


}
