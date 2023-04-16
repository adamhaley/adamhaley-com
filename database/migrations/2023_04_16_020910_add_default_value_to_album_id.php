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
        Schema::table('tracks', function (Blueprint $table) {
            //make album_id default null
            $table->unsignedBigInteger('album_id')->default(0)->change();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracks', function (Blueprint $table) {
            //undo that
            $table->unsignedBigInteger('album_id')->change();
        });
    }
};
