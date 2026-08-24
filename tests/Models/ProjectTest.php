<?php

namespace Tests\Models;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Project::class)]
class ProjectTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_orders_images_by_sort_order(): void
    {
        $project = Project::factory()->create();
        $project->images()->create(['path' => 'projects/second.jpg', 'sort_order' => 1]);
        $project->images()->create(['path' => 'projects/first.jpg', 'sort_order' => 0]);

        $this->assertSame(
            ['projects/first.jpg', 'projects/second.jpg'],
            $project->images->pluck('path')->all(),
        );
    }
}
