<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageBoard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identifier',
        'description',
    ];

    public function imageBoardPosts()
    {
        return $this->hasMany(ImageBoardPost::class);
    }
}
