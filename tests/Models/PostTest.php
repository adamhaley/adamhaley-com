<?php

namespace Tests\Models;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Post::class)]
class PostTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_orders_images_by_sort_order(): void
    {
        $post = Post::factory()->create();
        $post->images()->create(['path' => 'posts/second.jpg', 'sort_order' => 1]);
        $post->images()->create(['path' => 'posts/first.jpg', 'sort_order' => 0]);

        $this->assertSame(
            ['posts/first.jpg', 'posts/second.jpg'],
            $post->images->pluck('path')->all(),
        );
    }
}
