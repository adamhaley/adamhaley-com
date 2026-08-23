<?php

namespace Tests\Filament\Resources;

use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Pages\ManagePosts;
use App\Models\Post;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(PostResource::class)]
class PostResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    #[Test]
    public function it_renders_the_manage_page(): void
    {
        $this->actingAs(User::factory()->create());
        Post::factory()->create(['title' => 'Rendered Post']);

        Livewire::test(ManagePosts::class)
            ->assertSuccessful()
            ->assertSee('Rendered Post');
    }

    #[Test]
    public function it_renders_the_view_slide_over(): void
    {
        $this->actingAs(User::factory()->create());
        $post = Post::factory()->create(['raw' => 'Some raw notes to review']);

        Livewire::test(ManagePosts::class)
            ->mountTableAction('view', $post)
            ->assertSuccessful();
    }
}
