<?php

namespace Tests\Filament\Resources;

use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Project;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ProjectResource::class)]
class ProjectResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    #[Test]
    public function it_renders_the_list_page(): void
    {
        $this->actingAs(User::factory()->create());
        Project::factory()->create(['name' => 'Rendered Project']);

        Livewire::test(ListProjects::class)
            ->assertSuccessful()
            ->assertSee('Rendered Project');
    }

    #[Test]
    public function it_renders_the_edit_page(): void
    {
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();

        Livewire::test(EditProject::class, ['record' => $project->getKey()])
            ->assertSuccessful();
    }

    #[Test]
    public function it_mounts_the_manage_images_action_for_a_project_with_existing_images(): void
    {
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();
        $project->images()->create(['path' => 'projects/first.jpg', 'sort_order' => 0]);
        $project->images()->create(['path' => 'projects/second.jpg', 'sort_order' => 1]);

        Livewire::test(EditProject::class, ['record' => $project->getKey()])
            ->mountAction('manageImages')
            ->assertSuccessful();
    }
}
