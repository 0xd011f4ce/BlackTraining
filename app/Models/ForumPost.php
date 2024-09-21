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
        "is_reply",
        "reply_to",
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

    public function postReplies()
    {
        return $this->hasMany(ForumPost::class, "reply_to");
    }

    public function lastReply()
    {
        return $this->hasOne(ForumPost::class, "reply_to")->latest();
    }
}
