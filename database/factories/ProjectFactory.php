<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => ProjectCategory::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'image' => 'projects/'.$this->faker->uuid().'.jpg',
            'link' => $this->faker->url(),
            'github' => $this->faker->url(),
            'tags' => implode(',', $this->faker->words(3)),
            'date' => $this->faker->date(),
        ];
    }
}
