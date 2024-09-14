<?php

namespace App\Http\Controllers;

use App\Models\ImageBoard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImageBoardController extends Controller
{
    public function index()
    {
        $boards = ImageBoard::all();

        return view("boards.index", compact("boards"));
    }

    public function show(ImageBoard $board)
    {
        $posts = $board->imageBoardPosts()->latest()->simplePaginate(10);

        return view("boards.show", compact("board", "posts"));
    }

    public function store(ImageBoard $board, Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "body" => "required|string",
        ]);

        $image = $request->file("image");
        $image_name = time() . "." . $image->getClientOriginalExtension();

        $imageServer = Image::read($image);
        $imagePath = public_path("uploads/boards") . "/" . $image_name;
        $imageServer->save($imagePath);

        $slug = Str::slug($request->title);

        $board->imageBoardPosts()->create([
            "title" => $request->title,
            "slug" => $slug,
            "body" => $request->body,
            "image" => $image_name,
            "user_id" => auth()->id(),
            "image_board_id" => $board->id,
        ]);

        return back();
    }
}
