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
}
