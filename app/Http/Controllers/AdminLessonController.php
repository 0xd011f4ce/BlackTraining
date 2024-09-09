<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSection;

class AdminLessonController extends Controller
{
    public function store(Request $request, Course $course, CourseSection $course_section)
    {
        $slug = Str::slug($request->lesson_name) . "-section-" . $course_section->id;
        if ($course_section->lessons()->where("slug", $slug)->exists()) {
            return back()->with("error", "A lesson with this name already exists in this section");
        }

        $request->validate([
            "lesson_name" => "required",
            "lesson_content" => "required",
        ]);

        $course_section->lessons()->create([
            "name" => $request->lesson_name,
            "slug" => $slug,
            "content" => $request->lesson_content,
            "course_id" => $course->id,
            "course_section_id" => $course_section->id,
        ]);

        return back()->with("success", "Lesson created successfully");
    }
}
