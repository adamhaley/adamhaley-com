<?php

namespace Tests\Filament\Resources;

use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
    public function it_renders_the_create_page(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateProject::class)
            ->assertSuccessful();
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
    public function it_rejects_an_end_date_before_the_start_date(): void
    {
        $this->actingAs(User::factory()->create());
        $category = ProjectCategory::factory()->create();

        Livewire::test(CreateProject::class)
            ->fillForm([
                'category_id' => $category->id,
                'name' => 'Date Range Project',
                'description' => 'A project used to test date range validation.',
                'image' => UploadedFile::fake()->image('test.jpg'),
                'link' => 'https://example.com',
                'github' => 'https://github.com/example/example',
                'tags' => ['tag'],
                'start_date' => '2026-01-10',
                'end_date' => '2026-01-01',
            ])
            ->call('create')
            ->assertHasFormErrors(['end_date']);
    }

    #[Test]
    public function it_allows_a_blank_end_date_for_an_ongoing_project(): void
    {
        $this->actingAs(User::factory()->create());
        $category = ProjectCategory::factory()->create();

        Livewire::test(CreateProject::class)
            ->fillForm([
                'category_id' => $category->id,
                'name' => 'Ongoing Project',
                'description' => 'A project used to test an optional end date.',
                'image' => UploadedFile::fake()->image('test.jpg'),
                'link' => 'https://example.com',
                'github' => 'https://github.com/example/example',
                'tags' => ['tag'],
                'start_date' => '2026-01-10',
                'end_date' => null,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', [
            'name' => 'Ongoing Project',
            'end_date' => null,
        ]);
    }

    #[Test]
    public function it_persists_the_category_filter_in_the_session_across_visits(): void
    {
        $this->actingAs(User::factory()->create());
        $category = ProjectCategory::factory()->create();
        $matching = Project::factory()->create(['category_id' => $category->id]);
        $other = Project::factory()->create();

        Livewire::test(ListProjects::class)
            ->filterTable('category_id', $category->id);

        Livewire::test(ListProjects::class)
            ->assertCanSeeTableRecords([$matching])
            ->assertCanNotSeeTableRecords([$other]);
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
