<?php

namespace Tests\Filament\Resources;

use App\Filament\Resources\ProspectResource;
use App\Filament\Resources\ProspectResource\Pages\EditProspect;
use App\Filament\Resources\ProspectResource\Pages\ListProspects;
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
    public function it_renders_the_list_page(): void
    {
        $this->actingAs(User::factory()->create());
        Prospect::factory()->create(['name' => 'Rendered Lead']);

        Livewire::test(ListProspects::class)
            ->assertSuccessful()
            ->assertSee('Rendered Lead');
    }

    #[Test]
    public function it_renders_the_edit_page(): void
    {
        $this->actingAs(User::factory()->create());
        $prospect = Prospect::factory()->create();

        Livewire::test(EditProspect::class, ['record' => $prospect->getRouteKey()])
            ->assertSuccessful();
    }

    #[Test]
    public function it_promotes_a_prospect_from_the_table_action(): void
    {
        $this->actingAs(User::factory()->create());
        $prospect = Prospect::factory()->create(['name' => 'Table Action Lead']);

        Livewire::test(ListProspects::class)
            ->callTableAction('promote', $prospect);

        $this->assertDatabaseHas('clients', ['name' => 'Table Action Lead']);
    }
}
