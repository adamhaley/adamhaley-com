<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('prospects')->where('status', 'rejected')->update(['status' => 'disqualified']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('prospects')->where('status', 'disqualified')->update(['status' => 'rejected']);
    }
};
