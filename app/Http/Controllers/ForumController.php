<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ForumCategory;

class ForumController extends Controller
{
    public function index()
    {
        $forums = ForumCategory::all();

        return view("forum.index", compact("forums"));
    }

    public function show(ForumCategory $forum_category)
    {
        $posts = ForumPost::where("forum_category_id", $forum_category->id)->simplePaginate(25);
        $posts->appends(["sort" => "created_at"]);

        return view("forum.show", [
            "forum" => $forum_category,
            "posts" => $posts
        ]);
    }

    public function post(ForumCategory $forum_category)
    {
        return view("forum.post", [
            "forum" => $forum_category
        ]);
    }

    public function store(ForumCategory $forum_category, Request $request)
    {
        $request->validate([
            "title" => "required",
            "content" => "required"
        ]);

        $slug = Str::slug($request->title . "-" . time());

        ForumPost::create([
            "name" => $request->title,
            "slug" => $slug,
            "content" => $request->content,
            "tags" => $request->tags ?? "",
            "user_id" => auth()->id(),
            "forum_category_id" => $forum_category->id
        ]);

        $forum_category->topics += 1;
        $forum_category->save();

        return redirect()->route("forum.show", $forum_category->slug);
    }
}
