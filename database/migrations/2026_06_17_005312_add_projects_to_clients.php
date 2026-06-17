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
        // Create pivot table for many-to-many relationship between clients and projects
        Schema::create('client_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['client_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_project');
    }
};
