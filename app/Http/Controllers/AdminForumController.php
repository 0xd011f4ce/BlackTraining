<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ForumCategory;

class AdminForumController extends Controller
{
    public function index()
    {
        $forums = ForumCategory::all();

        return view("admin.forum.new", compact("forums"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:forum_categories",
            "description" => "required"
        ]);

        $slug = Str::slug($request->name);

        ForumCategory::create([
            "name" => $request->name,
            "slug" => $slug,
            "description" => $request->description,
            "parent_id" => $request->parent_id ?? null,
            "position" => $request->position ?? 0
        ]);

        return redirect(route("admin.index"))->with("success", "Forum created successfully");
    }
}
