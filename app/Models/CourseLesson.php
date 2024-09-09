<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "content",
        "course_id",
        "course_section_id",
    ];
}
