<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\CourseSection;

class AdminLessonController extends Controller
{
    public function store(Request $request, Course $course, CourseSection $course_section)
    {
        $slug = Str::slug($request->lesson_name) . "-section-" . $course_section->id;
        if ($course_section->courseLessons()->where("slug", $slug)->exists()) {
            return back()->with("error", "A lesson with this name already exists in this section");
        }

        $request->validate([
            "lesson_name" => "required",
            "lesson_content" => "required",
        ]);

        $course_section->courseLessons()->create([
            "name" => $request->lesson_name,
            "slug" => $slug,
            "content" => $request->lesson_content,
            "course_id" => $course->id,
            "course_section_id" => $course_section->id,
        ]);

        // update course's updated_at
        $course->touch();

        return back()->with("success", "Lesson created successfully");
    }

    public function edit(Request $request, Course $course, CourseSection $course_section, CourseLesson $course_lesson)
    {
        return view("admin.lessons.edit", [
            "course" => $course,
            "section" => $course_section,
            "lesson" => $course_lesson
        ]);
    }

    public function update(Request $request, Course $course, CourseSection $course_section, CourseLesson $course_lesson)
    {
        $request->validate([
            "name" => "required",
            "content" => "required"
        ]);

        $course_lesson->name = $request->name;
        $course_lesson->content = $request->content;
        $course_lesson->save();

        $course->touch();

        return redirect()->route("admin.course.lessons.edit", [
            "course" => $course->slug,
            "course_section" => $course_section->slug,
            "course_lesson" => $course_lesson->slug
        ])->with("success", "Lesson updated successfully");
    }

    public function delete(Course $course, CourseSection $course_section, CourseLesson $course_lesson)
    {
        $course_lesson->delete();

        $course->touch();

        return redirect()->route("admin.course.sections.edit", [
            "course" => $course->slug,
            "course_section" => $course_section->slug
        ])->with("success", "Lesson deleted successfully");
    }
}
