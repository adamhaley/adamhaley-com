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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('source');
            $table->string('source_external_id')->nullable();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->text('summary')->nullable();
            $table->string('status')->default('new');
            $table->json('raw_payload')->nullable();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->unique(['source', 'source_external_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
