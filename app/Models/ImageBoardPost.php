<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageBoardPost extends Model
{
    use HasFactory;

    protected $fillable = [
        "image_board_id",
        "user_id",
        "title",
        "body",
        "image",
        "slug",
    ];
}