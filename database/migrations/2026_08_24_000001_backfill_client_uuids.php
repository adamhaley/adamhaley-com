<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // The migration that added `uuid` left existing rows null (only new
        // inserts get one via the model's creating hook), which breaks
        // Filament's uuid-keyed edit routes for any pre-existing client.
        DB::table('clients')->whereNull('uuid')->orderBy('id')->each(function (object $client): void {
            DB::table('clients')->where('id', $client->id)->update(['uuid' => (string) Str::uuid()]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally irreversible: nulling uuids back out would re-break
        // Filament's edit routes for the rows this backfilled.
    }
};
