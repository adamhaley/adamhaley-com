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
        Schema::table('media', function (Blueprint $table) {
            //add foreign key to media categories table
            $table->foreignId('category_id')->after('id')->constrained('media_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_categories', function (Blueprint $table) {
            //drop category_id
            $table->dropForeign(['category_id']);
        });
    }
};
