<?php

namespace App\Http\Controllers;

use App\Models\ImageBoard;
use Illuminate\Http\Request;

class ImageBoardController extends Controller
{
    public function index()
    {
        $boards = ImageBoard::all();

        return view("boards.index", compact("boards"));
    }

    public function show(ImageBoard $board) {}
}
