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
        //make cover art field nullable
        Schema::table('albums', function (Blueprint $table) {
            $table->string('cover_art')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //revert
        Schema::table('albums', function (Blueprint $table) {
            $table->string('cover_art')->change();
        });
    }
};
