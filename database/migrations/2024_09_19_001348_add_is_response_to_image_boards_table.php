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
        Schema::table('image_boards', function (Blueprint $table) {
            $table->boolean('is_response')->default(false);
            $table->foreignId('response_to')->nullable()->constrained('image_boards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('image_boards', function (Blueprint $table) {
            $table->dropColumn('is_response');
            $table->dropForeign(['response_to']);
            $table->dropColumn('response_to');
        });
    }
};
