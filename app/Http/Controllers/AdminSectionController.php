<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminSectionController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $slug = Str::slug($request->section_name) . "-course-" . $course->id;

        // check if slug exists
        $section = $course->courseSections()->where("slug", $slug)->first();
        if ($section) {
            return back()->with("error", "Section with this name already exists");
        }

        $request->validate([
            "section_name" => "required",
            "section_description" => "required",
        ]);

        $section = $course->courseSections()->create([
            "name" => $request->section_name,
            "slug" => $slug,
            "description" => $request->section_description,
            "course_id" => $course->id,
        ]);

        $course->touch();

        return redirect()->route("admin.course.edit", $course->slug)->with("success", "Section created successfully.");
    }

    public function edit(Course $course, CourseSection $course_section)
    {
        return view("admin.sections.edit", compact("course", "course_section"));
    }

    public function update(Request $request, Course $course, CourseSection $course_section)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
        ]);

        $course_section->name = $request->name;
        $course_section->description = $request->description;
        $course_section->save();

        $course->touch();

        return redirect()->route("admin.course.sections.update", compact("course", "course_section"))->with("success", "Section updated successfully.");
    }

    public function destroy(Request $request, Course $course, CourseSection $course_section)
    {
        $course_section->delete();
        $course->touch();

        return redirect()->route("admin.course.edit", $course->slug)->with("success", "Section deleted successfully.");
    }
}
