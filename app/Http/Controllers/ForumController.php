<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = ForumCategory::all();

        return view("forum.index", compact("forums"));
    }
}
