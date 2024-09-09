<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "course_id"
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseLessons()
    {
        return $this->hasMany(CourseLesson::class);
    }
}
