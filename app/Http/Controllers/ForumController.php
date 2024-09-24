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
        $posts = ForumPost::where([
            ["forum_category_id", "=", $forum_category->id],
            ["is_reply", "=", false]
        ])->simplePaginate(25);
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
        $forum_category->posts += 1;
        $forum_category->save();

        return redirect()->route("forum.show", $forum_category->slug);
    }

    public function thread(ForumCategory $forum_category, ForumPost $forum_post)
    {
        $forum_post->views++;
        $forum_post->save();

        return view("forum.thread", [
            "forum" => $forum_category,
            "thread" => $forum_post
        ]);
    }

    public function reply(ForumCategory $forum_category, ForumPost $forum_post, Request $request)
    {
        $request->validate([
            "reply" => "required"
        ]);

        ForumPost::create([
            "name" => "Re: " . $forum_post->name,
            "slug" => $forum_post->slug . "-" . time(),
            "content" => $request->reply,
            "tags" => $request->tags ?? "",
            "user_id" => auth()->id(),
            "forum_category_id" => $forum_category->id,
            "is_reply" => true,
            "reply_to" => $forum_post->id
        ]);

        $forum_post->replies += 1;
        $forum_post->save();

        $forum_category->posts += 1;
        $forum_category->save();

        return redirect()->route("forum.thread", [$forum_category->slug, $forum_post->slug]);
    }

    public function edit(ForumCategory $forum_category, ForumPost $forum_post)
    {
        // check if the logged in user is the owner of this thread
        if ($forum_post->user_id !== auth()->id() || auth()->user()->role !== "admin") {
            return redirect()->route("forum.thread", [$forum_category->slug, $forum_post->slug]);
        }

        return view("forum.edit", [
            "forum" => $forum_category,
            "post" => $forum_post
        ]);
    }

    public function editStore(ForumCategory $forum_category, ForumPost $forum_post, Request $request)
    {
        // check if the logged in user is the owner of this thread
        if ($forum_post->user_id !== auth()->id() || auth()->user()->role !== "admin") {
            return redirect()->route("forum.thread", [$forum_category->slug, $forum_post->slug]);
        }

        $request->validate([
            "title" => "required",
            "content" => "required"
        ]);

        $forum_post->name = $request->title;
        $forum_post->content = $request->content;
        $forum_post->tags = $request->tags ?? "";
        $forum_post->save();

        return redirect()->route("forum.thread", [$forum_category->slug, $forum_post->slug]);
    }
}
