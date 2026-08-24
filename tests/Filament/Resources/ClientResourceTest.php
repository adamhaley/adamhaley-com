<?php

namespace Tests\Filament\Resources;

use App\Filament\Resources\ClientResource;
use App\Filament\Resources\ClientResource\Pages\EditClient;
use App\Filament\Resources\ClientResource\Pages\ListClients;
use App\Models\Client;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ClientResource::class)]
class ClientResourceTest extends TestCase
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
        Client::factory()->create(['name' => 'Rendered Client']);

        Livewire::test(ListClients::class)
            ->assertSuccessful()
            ->assertSee('Rendered Client');
    }

    #[Test]
    public function it_renders_the_edit_page_using_the_uuid_route_key(): void
    {
        $this->actingAs(User::factory()->create());
        $client = Client::factory()->create();

        Livewire::test(EditClient::class, ['record' => $client->uuid])
            ->assertSuccessful();
    }
}
