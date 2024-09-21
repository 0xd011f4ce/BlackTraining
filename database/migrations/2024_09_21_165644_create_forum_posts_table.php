<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("slug")->unique();

            $table->text("content");
            $table->text("tags")->nullable();

            $table->integer("replies")->default(0);
            $table->integer("views")->default(0);

            $table->boolean("is_locked")->default(false);
            $table->boolean("is_pinned")->default(false);

            $table->boolean("is_reply")->default(false);
            $table->foreignId("reply_to")->nullable();

            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("forum_category_id")->constrained()->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
