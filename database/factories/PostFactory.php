<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1, 1_000_000),
            'raw' => $this->faker->paragraphs(3, true),
            'ai_draft' => null,
            'ai_draft_generated_at' => null,
            'body' => '<p>'.$this->faker->paragraph().'</p>',
            'tags' => implode(',', $this->faker->words(3)),
        ];
    }
}
