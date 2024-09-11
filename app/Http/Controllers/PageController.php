<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Parsedown;

class PageController extends Controller
{
    public function show(Request $request, Page $page)
    {
        $content = Parsedown::instance()->text($page->content);

        return view("page", compact("page", "content"));
    }
}
