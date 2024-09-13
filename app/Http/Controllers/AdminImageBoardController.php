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

    public function show()
    {
        $boards = ImageBoard::all();

        return view("admin.boards.manage", compact("boards"));
    }

    public function edit(ImageBoard $board)
    {
        return view("admin.boards.edit", compact("board"));
    }

    public function update(Request $request, ImageBoard $board)
    {
        $request->validate([
            "name" => "required",
            "identifier" => "required",
            "description" => "required",
        ]);

        $board->name = $request->name;
        $board->identifier = $request->identifier;
        $board->description = $request->description;
        $board->save();

        return back()->with("success", "Board updated successfully.");
    }

    public function delete(ImageBoard $board)
    {
        $board->delete();

        return redirect(route("admin.boards.show"))->with("success", "Board deleted successfully.");
    }
}
