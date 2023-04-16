<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add default album
        Album::firstOrCreate([
            'name' => 'Default Album',
            'description' => 'Default album for tracks without an album',
        ]);

        //add Axis Of The Bridge
        Album::firstOrCreate([
            'name' => 'Axis Of The Bridge',
            'description' => 'Axis Of The Bridge',
        ]);

        //add AH:1
        Album::firstOrCreate([
            'name' => 'AH:1',
            'description' => 'AH:1',
        ]);

    }
}
