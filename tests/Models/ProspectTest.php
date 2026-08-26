<?php

namespace Tests\Models;

use App\Enums\ProspectStatus;
use App\Models\Prospect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Prospect::class)]
class ProspectTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_marks_a_new_status(): void
    {
        $prospect = Prospect::factory()->create(['status' => ProspectStatus::New]);

        $prospect->markStatus(ProspectStatus::Qualified);

        $this->assertSame(ProspectStatus::Qualified, $prospect->fresh()->status);
    }

    #[Test]
    public function it_marks_viewed_when_new(): void
    {
        $prospect = Prospect::factory()->create(['status' => ProspectStatus::New]);

        $prospect->markViewedIfNew();

        $this->assertSame(ProspectStatus::Viewed, $prospect->fresh()->status);
    }

    #[Test]
    public function it_does_not_mark_viewed_when_not_new(): void
    {
        $prospect = Prospect::factory()->create(['status' => ProspectStatus::Qualified]);

        $prospect->markViewedIfNew();

        $this->assertSame(ProspectStatus::Qualified, $prospect->fresh()->status);
    }
}
