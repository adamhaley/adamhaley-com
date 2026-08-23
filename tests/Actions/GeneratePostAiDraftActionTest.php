<?php

namespace Tests\Actions;

use App\Actions\GeneratePostAiDraftAction;
use App\Ai\Agents\PostDraftGenerator;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Ai\Prompts\AgentPrompt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use RuntimeException;
use Tests\TestCase;

#[CoversClass(GeneratePostAiDraftAction::class)]
class GeneratePostAiDraftActionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_generates_and_persists_an_ai_draft_from_raw_notes(): void
    {
        PostDraftGenerator::fake([
            ['draft' => '<p>A fully drafted post.</p>'],
        ])->preventStrayPrompts();

        $post = Post::factory()->create([
            'title' => 'Shipping Faster',
            'raw' => 'Bullet points about shipping faster with small diffs.',
            'ai_draft' => null,
        ]);

        $updated = (new GeneratePostAiDraftAction)($post);

        $this->assertSame('<p>A fully drafted post.</p>', $updated->ai_draft);
        $this->assertNotNull($updated->fresh()->ai_draft_generated_at);

        PostDraftGenerator::assertPrompted(
            fn (AgentPrompt $prompt): bool => $prompt->contains('Shipping Faster')
                && $prompt->contains('Bullet points about shipping faster with small diffs.'),
        );
    }

    #[Test]
    public function it_throws_when_raw_notes_are_blank(): void
    {
        $post = Post::factory()->create(['raw' => null]);

        $this->expectException(RuntimeException::class);

        (new GeneratePostAiDraftAction)($post);
    }
}
