<?php

namespace Tests\Filament\Resources;

use App\Enums\ProspectStatus;
use App\Filament\Resources\ProspectResource;
use App\Filament\Resources\ProspectResource\Pages\ManageProspects;
use App\Models\Prospect;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ProspectResource::class)]
class ProspectResourceTest extends TestCase
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
        Prospect::factory()->create(['name' => 'Rendered Lead']);

        Livewire::test(ManageProspects::class)
            ->assertSuccessful()
            ->assertSee('Rendered Lead');
    }

    #[Test]
    public function it_renders_the_view_slide_over(): void
    {
        $this->actingAs(User::factory()->create());
        $prospect = Prospect::factory()->create(['summary' => 'A detailed summary']);

        Livewire::test(ManageProspects::class)
            ->mountTableAction('view', $prospect)
            ->assertSuccessful();
    }

    #[Test]
    public function it_sorts_by_most_recently_created_by_default(): void
    {
        $this->actingAs(User::factory()->create());
        $older = Prospect::factory()->create(['name' => 'Older Lead', 'created_at' => now()->subDay()]);
        $newer = Prospect::factory()->create(['name' => 'Newer Lead', 'created_at' => now()]);

        Livewire::test(ManageProspects::class)
            ->assertSuccessful()
            ->assertSeeInOrder([$newer->name, $older->name]);
    }

    #[Test]
    public function it_applies_filters_immediately_without_an_apply_button(): void
    {
        $this->actingAs(User::factory()->create());
        $newProspect = Prospect::factory()->create(['status' => ProspectStatus::New]);
        $disqualifiedProspect = Prospect::factory()->create(['status' => ProspectStatus::Disqualified]);

        Livewire::test(ManageProspects::class)
            ->assertCanSeeTableRecords([$newProspect, $disqualifiedProspect])
            ->filterTable('status', ProspectStatus::New->value)
            ->assertCanSeeTableRecords([$newProspect])
            ->assertCanNotSeeTableRecords([$disqualifiedProspect]);
    }

    #[Test]
    public function it_persists_table_filters_in_the_session_across_visits(): void
    {
        $this->actingAs(User::factory()->create());
        $newProspect = Prospect::factory()->create(['status' => ProspectStatus::New]);
        $disqualifiedProspect = Prospect::factory()->create(['status' => ProspectStatus::Disqualified]);

        Livewire::test(ManageProspects::class)
            ->filterTable('status', ProspectStatus::New->value);

        Livewire::test(ManageProspects::class)
            ->assertCanSeeTableRecords([$newProspect])
            ->assertCanNotSeeTableRecords([$disqualifiedProspect]);
    }
}
