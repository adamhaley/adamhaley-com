<?php

namespace Database\Seeders;

use App\Models\MediaCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create two media categories: Image and Video
        MediaCategory::firstOrCreate([
            'name' => 'Image',
            'description' => 'Image files',
        ]);

        MediaCategory::firstOrCreate([
            'name' => 'Video',
            'description' => 'Video files',
        ]);
    }
}
