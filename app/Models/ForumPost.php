<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "content",
        "tags",
        "replies",
        "views",
        "is_locked",
        "is_pinned",
        "user_id",
        "forum_category_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function forumCategory()
    {
        return $this->belongsTo(ForumCategory::class, "forum_category_id");
    }
}
