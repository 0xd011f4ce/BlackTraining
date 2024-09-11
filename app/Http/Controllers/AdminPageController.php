<?php

namespace App\Http\Controllers;

use App\Models\Page;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        return view("admin.pages.new");
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->name);

        // check if the slug already exists
        $pages = Page::where("slug", $slug)->count();
        if ($pages > 0) {
            return back()->with("error", "There's already a page with that name.");
        }

        $request->validate([
            "name" => "required",
            "path" => "required|unique:pages",
            "content" => "required"
        ]);

        $page = new Page();
        $page->name = $request->name;
        $page->slug = $slug;
        $page->path = $request->path;
        $page->content = $request->content;
        $page->save();

        return back()->with("success", "Page created successfully.");
    }
}
