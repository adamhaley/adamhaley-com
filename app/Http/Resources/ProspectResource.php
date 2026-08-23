<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProspectResource extends JsonResource
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
            'name' => $this->name,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'location' => $this->latitude !== null && $this->longitude !== null
                ? ['latitude' => $this->latitude, 'longitude' => $this->longitude]
                : null,
            'summary' => $this->summary,
            'status' => $this->status->value,
            'client_id' => $this->client?->id,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
