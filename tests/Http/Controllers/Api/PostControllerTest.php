<?php

namespace Tests\Http\Controllers\Api;

use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(PostController::class)]
class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_rejects_requests_without_a_token(): void
    {
        $response = $this->postJson('/api/posts', ['title' => 'Hello World']);

        $response->assertStatus(401);
    }

    #[Test]
    public function it_rejects_a_token_without_the_posts_ability(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['some-other-ability']);

        $response = $this->postJson('/api/posts', ['title' => 'Hello World']);

        $response->assertStatus(403);
    }

    #[Test]
    public function it_creates_a_post_with_an_auto_generated_slug(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['posts:manage']);

        $response = $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'title' => 'Hello World',
            'raw' => 'The raw idea text.',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            'source' => 'second_brain_content_ideas',
            'title' => 'Hello World',
            'slug' => 'hello-world',
            'raw' => 'The raw idea text.',
        ]);
    }

    #[Test]
    public function it_does_not_merge_posts_from_a_source_with_no_external_id(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['posts:manage']);

        $this->postJson('/api/posts', ['source' => 'second_brain_content_ideas', 'title' => 'Idea A']);
        $this->postJson('/api/posts', ['source' => 'second_brain_content_ideas', 'title' => 'Idea B']);

        $this->assertSame(2, Post::where('source', 'second_brain_content_ideas')->count());
    }

    #[Test]
    public function it_matches_a_post_with_the_same_external_id_instead_of_duplicating(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['posts:manage']);

        $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'source_external_id' => 'idea-123',
            'title' => 'Idea v1',
        ]);
        $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'source_external_id' => 'idea-123',
            'title' => 'Idea v2',
        ]);

        $this->assertSame(1, Post::where('source', 'second_brain_content_ideas')->count());
    }

    #[Test]
    public function it_does_not_overwrite_an_existing_field_on_a_matched_post(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['posts:manage']);

        $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'source_external_id' => 'idea-123',
            'title' => 'Original Title',
        ]);
        $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'source_external_id' => 'idea-123',
            'title' => 'Renamed From Import',
        ]);

        $this->assertDatabaseHas('posts', [
            'source_external_id' => 'idea-123',
            'title' => 'Original Title',
        ]);
    }

    #[Test]
    public function it_fills_a_blank_field_on_a_matched_post(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['posts:manage']);

        $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'source_external_id' => 'idea-123',
            'title' => 'Idea v1',
        ]);
        $this->postJson('/api/posts', [
            'source' => 'second_brain_content_ideas',
            'source_external_id' => 'idea-123',
            'title' => 'Idea v1',
            'raw' => 'The full idea text arrives on the second call.',
        ]);

        $this->assertDatabaseHas('posts', [
            'source_external_id' => 'idea-123',
            'raw' => 'The full idea text arrives on the second call.',
        ]);
    }

    #[Test]
    public function it_lists_posts_filtered_by_source(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['posts:manage']);
        Post::factory()->create(['source' => 'second_brain_content_ideas']);
        Post::factory()->create(['source' => 'manual']);

        $response = $this->getJson('/api/posts?source=second_brain_content_ideas');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }
}
