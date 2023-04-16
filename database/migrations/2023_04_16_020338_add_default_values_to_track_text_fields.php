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
            //add default values to text fields
            $table->string('description')->default('')->change();
            $table->string('lyrics')->default('')->change();
            $table->string('file')->default('')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracks', function (Blueprint $table) {
            //revert
            $table->string('description')->change();
            $table->string('lyrics')->change();
            $table->string('file')->change();
        });
    }
};
