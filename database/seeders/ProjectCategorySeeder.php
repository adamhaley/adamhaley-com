<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed the project categories
        ProjectCategory::firstOrCreate([
            'name' => 'Web Development',
            'description' => 'All things programming, digital media, and creative web development',
        ]);

        ProjectCategory::firstOrCreate([
            'name' => 'Music',
            'description' => 'Music Projects',
        ]);

        ProjectCategory::firstOrCreate([
            'name' => 'Logo / Graphic Design',
            'description' => 'Logo, Branding and graphic design projects',
        ]);

        //add sub-categories
        $webDev = ProjectCategory::where('name', 'Web Development')->first();
        $music = ProjectCategory::where('name', 'Music')->first();

        //add categories with Web Development as parent
        ProjectCategory::firstOrCreate([
            'name' => 'Frontend',
            'description' => 'Javscript SPAs, immersive creative digital experiences, and more.',
            'parent_id' => $webDev->id,
        ]);

        ProjectCategory::firstOrCreate([
            'name' => 'Backend',
            'description' => 'Projects that were more focused on backend development, enterprise apps, etc.',
            'parent_id' => $webDev->id,
        ]);

        ProjectCategory::firstOrCreate([
            'name' => 'Early Projects',
            'description' => 'Earliest web dev projects, 1999-2000.',
            'parent_id' => $webDev->id,
        ]);

        //add categories with Music as parent

        ProjectCategory::firstOrCreate([
            'name' => 'AH Songs',
            'description' => 'AH Songs',
            'parent_id' => $music->id,
        ]);

        ProjectCategory::firstOrCreate([
            'name' => 'Cirque',
            'description' => 'Music for Cirque Nouveau projects',
            'parent_id' => $music->id,
        ]);
    }
}
