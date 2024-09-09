<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "duration",
        "published"
    ];

    public function courseSections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(CourseLesson::class, CourseSection::class);
    }
}
