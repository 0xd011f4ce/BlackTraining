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
        Schema::create('forum_categories', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("slug")->unique();
            $table->text("description")->nullable();
            $table->integer("topics")->default(0);
            $table->integer("posts")->default(0);

            $table->foreignId("parent_id")->nullable()->constrained("forum_categories")->nullOnDelete();
            $table->integer("position")->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_categories');
    }
};
