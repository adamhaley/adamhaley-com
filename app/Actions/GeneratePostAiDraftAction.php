<?php

namespace App\Actions;

use App\Ai\Agents\PostDraftGenerator;
use App\Models\Post;
use RuntimeException;

class GeneratePostAiDraftAction
{
    public function __invoke(Post $post): Post
    {
        if (blank($post->raw)) {
            throw new RuntimeException('Add raw notes before generating an AI draft.');
        }

        $response = (new PostDraftGenerator)->prompt($this->prompt($post));
        $draft = is_string($response['draft'] ?? null) ? trim($response['draft']) : '';

        if ($draft === '') {
            throw new RuntimeException('The AI draft generator did not return a usable draft.');
        }

        $post->update([
            'ai_draft' => $draft,
            'ai_draft_generated_at' => now(),
        ]);

        return $post;
    }

    private function prompt(Post $post): string
    {
        return sprintf(
            <<<'PROMPT'
Post title: %s

Raw notes:
%s
PROMPT,
            $post->title,
            $post->raw,
        );
    }
}
