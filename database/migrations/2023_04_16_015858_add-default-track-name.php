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
        //add default value of empty string to name field on tracks table
        Schema::table('tracks', function (Blueprint $table) {
            $table->string('name')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //remove default value of empty string from name field on tracks table
        Schema::table('tracks', function (Blueprint $table) {
            $table->string('name')->change();
        });
    }
};
