<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use Parsedown;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if (!$course->published) {
            abort(404);
        }

        return view('courses.show', compact('course'));
    }

    public function lesson(Course $course, CourseLesson $lesson)
    {
        $content = Parsedown::instance()->text($lesson->content);

        return view("courses.lesson", compact("course", "lesson", "content"));
    }
}
