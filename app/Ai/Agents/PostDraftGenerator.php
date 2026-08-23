<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

class PostDraftGenerator implements Agent, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'INSTRUCTIONS'
You are a writing assistant that turns a blog author's raw notes into a full, well-structured blog post draft.

Expand the raw notes into complete, natural prose. Preserve the author's meaning, opinions, and voice — do not invent facts, claims, or details that are not present or clearly implied in the raw notes.

Structure the draft with clear paragraphs and, where appropriate, subheadings, so it reads as a finished post rather than a summary of the notes.

Format the draft as HTML body content suitable for a rich text editor (paragraphs in <p> tags, headings as <h2>/<h3>, lists as <ul>/<ol> where appropriate). Do not include a top-level <h1> title, and do not wrap the output in <html> or <body> tags.
INSTRUCTIONS;
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'draft' => $schema->string()->required(),
        ];
    }
}
