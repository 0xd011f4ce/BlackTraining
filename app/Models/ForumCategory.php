<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "parent_id",
        "position",
        "topics",
        "posts"
    ];

    public function children()
    {
        return $this->hasMany(ForumCategory::class, "parent_id");
    }

    public function lastPost()
    {
        return $this->hasOne(ForumPost::class, "forum_category_id")->latest();
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class, "forum_category_id");
    }
}
