<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
            $table->string('source')->nullable()->after('uuid');
            $table->string('source_external_id')->nullable()->after('source');
            $table->json('raw_payload')->nullable()->after('tags');

            // A post created from a raw content idea has no tags yet -
            // matches body's existing nullable-until-drafted treatment.
            $table->string('tags')->nullable()->change();
        });

        DB::table('posts')->whereNull('uuid')->orderBy('id')->each(function ($post) {
            DB::table('posts')->where('id', $post->id)->update(['uuid' => (string) Str::uuid()]);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->change();
            $table->unique('uuid');
            $table->unique(['source', 'source_external_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['source', 'source_external_id']);
            $table->dropUnique(['uuid']);
            $table->dropColumn(['uuid', 'source', 'source_external_id', 'raw_payload']);
            $table->string('tags')->nullable(false)->change();
        });
    }
};
