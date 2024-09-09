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
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("slug");
            $table->text("content");

            $table->foreignId("course_id")->constrained()->onDelete("cascade");
            $table->foreignId("course_section_id")->constrained()->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
    }
};
