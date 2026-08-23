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
        Schema::table('posts', function (Blueprint $table) {
            $table->longText('raw')->nullable()->after('slug');
            $table->longText('ai_draft')->nullable()->after('raw');
            $table->timestamp('ai_draft_generated_at')->nullable()->after('ai_draft');
            $table->longText('body')->nullable(false)->change();
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image')->after('body');
            $table->string('body')->nullable(false)->change();
            $table->dropColumn(['raw', 'ai_draft', 'ai_draft_generated_at']);
        });
    }
};
