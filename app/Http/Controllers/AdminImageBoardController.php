<?php

namespace App\Http\Controllers;

use App\Models\ImageBoard;

use Illuminate\Http\Request;

class AdminImageBoardController extends Controller
{
    public function index()
    {
        return view("admin.boards.new");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "identifier" => "required|unique:image_boards",
            "description" => "required",
        ]);

        $board = new ImageBoard();
        $board->name = $request->name;
        $board->identifier = $request->identifier;
        $board->description = $request->description;
        $board->save();

        return redirect(route("admin.index"))->with("success", "Board created successfully.");
    }
}
