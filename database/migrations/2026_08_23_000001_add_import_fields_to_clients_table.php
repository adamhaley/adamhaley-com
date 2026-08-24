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
        Schema::table('clients', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->unique()->after('id');
            $table->string('source')->nullable()->after('uuid');
            $table->string('source_external_id')->nullable()->after('source');
            $table->json('raw_payload')->nullable()->after('url');

            // text: CRM/prospect summaries routinely exceed varchar(255).
            $table->text('description')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('url')->nullable()->change();

            $table->unique(['source', 'source_external_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique(['source', 'source_external_id']);
            $table->dropColumn(['uuid', 'source', 'source_external_id', 'raw_payload']);

            $table->string('description')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('url')->nullable(false)->change();
        });
    }
};
