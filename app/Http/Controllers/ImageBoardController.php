<?php

namespace App\Http\Controllers;

use App\Models\ImageBoard;
use App\Models\ImageBoardPost;
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

        $slug = Str::slug($request->title . "-" . time());

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

    public function thread(ImageBoard $board, ImageBoardPost $imageBoardPost)
    {
        return view("boards.thread", [
            "board" => $board,
            "post" => $imageBoardPost
        ]);
    }

    public function reply(ImageBoard $board, ImageBoardPost $imageBoardPost, Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "body" => "required|string"
        ]);

        $slug = Str::slug($request->title . "-" . time());

        $reply = $imageBoardPost->responses()->create([
            "title" => $request->title,
            "slug" => $slug,
            "body" => $request->body,
            "user_id" => auth()->id(),
            "image_board_id" => $board->id,
            "is_response" => true,
            "response_to" => $imageBoardPost->id
        ]);

        return back();
    }
}
