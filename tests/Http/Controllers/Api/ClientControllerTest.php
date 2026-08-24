<?php

namespace Tests\Http\Controllers\Api;

use App\Http\Controllers\Api\ClientController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ClientController::class)]
class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_rejects_requests_without_a_token(): void
    {
        $response = $this->postJson('/api/clients', ['name' => 'Acme Co']);

        $response->assertStatus(401);
    }

    #[Test]
    public function it_rejects_a_token_without_the_clients_ability(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['some-other-ability']);

        $response = $this->postJson('/api/clients', ['name' => 'Acme Co']);

        $response->assertStatus(403);
    }

    #[Test]
    public function it_creates_a_client(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['clients:manage']);

        $response = $this->postJson('/api/clients', [
            'source' => 'contract_import',
            'name' => 'Acme Co',
            'email' => 'billing@acme.test',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('clients', [
            'source' => 'contract_import',
            'name' => 'Acme Co',
        ]);
    }

    #[Test]
    public function it_does_not_merge_clients_from_a_source_with_no_external_id(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['clients:manage']);

        $this->postJson('/api/clients', ['source' => 'contract_import', 'name' => 'Client A']);
        $this->postJson('/api/clients', ['source' => 'contract_import', 'name' => 'Client B']);

        $this->assertSame(2, Client::where('source', 'contract_import')->count());
    }

    #[Test]
    public function it_upserts_a_client_with_a_matching_external_id(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['clients:manage']);

        $this->postJson('/api/clients', [
            'source' => 'contract_import',
            'source_external_id' => 'company-123',
            'name' => 'Client v1',
        ]);
        $this->postJson('/api/clients', [
            'source' => 'contract_import',
            'source_external_id' => 'company-123',
            'name' => 'Client v2',
        ]);

        $this->assertSame(1, Client::where('source', 'contract_import')->count());
        $this->assertDatabaseHas('clients', [
            'source_external_id' => 'company-123',
            'name' => 'Client v2',
        ]);
    }

    #[Test]
    public function it_lists_clients_filtered_by_source(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['clients:manage']);
        Client::factory()->create(['source' => 'contract_import']);
        Client::factory()->create(['source' => 'prospect']);

        $response = $this->getJson('/api/clients?source=prospect');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }
}
