<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminCoursecontroller extends Controller
{
    public function index()
    {
        return view("admin.courses.new");
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->name);

        // check if the slug already exists
        $count = Course::where("slug", $slug)->count();
        if ($count > 0) {
            return back()->with("error", "There's already a course with that name.");
        }

        $request->validate([
            "name" => "required",
            "description" => "required",
            "duration" => "required",
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->slug = $slug;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->published = false;
        $course->save();

        return redirect()->route("admin.index")->with("success", "Course created successfully.");
    }

    public function show()
    {
        $courses = Course::all();
        return view("admin.courses.manage", compact("courses"));
    }

    public function edit(Course $course)
    {
        return view("admin.courses.edit", compact("course"));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "duration" => "required",
        ]);

        $course->name = $request->name;
        $course->description = $request->description;
        $course->duration = $request->duration;

        if ($request->has("published"))
            $course->published = true;
        else
            $course->published = false;

        $course->save();

        return redirect()->route("admin.course.edit", ["course" => $course->slug])->with("success", "Course updated successfully.");
    }

    public function delete(Course $course)
    {
        $course->delete();
        return redirect()->route("admin.courses.show")->with("success", "Course deleted successfully.");
    }
}
