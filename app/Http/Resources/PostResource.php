<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'source' => $this->source,
            'source_external_id' => $this->source_external_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'raw' => $this->raw,
            'ai_draft' => $this->ai_draft,
            'ai_draft_generated_at' => $this->ai_draft_generated_at?->toIso8601String(),
            'body' => $this->body,
            'tags' => $this->tags,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
