<?php

namespace Tests\Http\Controllers\Api;

use App\Enums\ProspectStatus;
use App\Http\Controllers\Api\ProspectController;
use App\Models\Client;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ProspectController::class)]
class ProspectControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_rejects_requests_without_a_token(): void
    {
        $response = $this->postJson('/api/prospects', ['source' => 'field_report']);

        $response->assertStatus(401);
    }

    #[Test]
    public function it_rejects_a_token_without_the_prospects_ability(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['some-other-ability']);

        $response = $this->postJson('/api/prospects', ['source' => 'field_report']);

        $response->assertStatus(403);
    }

    #[Test]
    public function it_creates_a_prospect(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['prospects:manage']);

        $response = $this->postJson('/api/prospects', [
            'source' => 'field_report',
            'name' => 'Coffee Shop Lead',
            'summary' => 'Owner interested in a website.',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('prospects', [
            'source' => 'field_report',
            'name' => 'Coffee Shop Lead',
        ]);
    }

    #[Test]
    public function it_does_not_merge_prospects_from_a_source_with_no_external_id(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['prospects:manage']);

        $this->postJson('/api/prospects', ['source' => 'field_report', 'name' => 'Report A']);
        $this->postJson('/api/prospects', ['source' => 'field_report', 'name' => 'Report B']);

        $this->assertSame(2, Prospect::where('source', 'field_report')->count());
    }

    #[Test]
    public function it_upserts_a_prospect_with_a_matching_external_id(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['prospects:manage']);

        $this->postJson('/api/prospects', [
            'source' => 'upwork',
            'source_external_id' => 'job-123',
            'name' => 'Job v1',
        ]);
        $this->postJson('/api/prospects', [
            'source' => 'upwork',
            'source_external_id' => 'job-123',
            'name' => 'Job v2',
        ]);

        $this->assertSame(1, Prospect::where('source', 'upwork')->count());
        $this->assertDatabaseHas('prospects', [
            'source_external_id' => 'job-123',
            'name' => 'Job v2',
        ]);
    }

    #[Test]
    public function it_lists_prospects_filtered_by_status(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['prospects:manage']);
        Prospect::factory()->create(['status' => ProspectStatus::New]);
        Prospect::factory()->create(['status' => ProspectStatus::Converted]);

        $response = $this->getJson('/api/prospects?status=converted');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    #[Test]
    public function it_promotes_a_prospect_to_a_client(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['prospects:manage']);
        $prospect = Prospect::factory()->create(['name' => 'Promotable Lead']);

        $response = $this->postJson("/api/prospects/{$prospect->uuid}/promote");

        $response->assertStatus(200);
        $response->assertJsonPath('data.status', 'converted');
        $this->assertDatabaseHas('clients', ['name' => 'Promotable Lead']);
        $this->assertSame(ProspectStatus::Converted, $prospect->fresh()->status);
    }
}
