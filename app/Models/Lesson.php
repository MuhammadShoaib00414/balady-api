<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;


    public function section()
    {
        return $this->belongsTo(Section::class);
    }


    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function images()
    {
        return $this->hasMany(LessonImage::class);
    }
}
