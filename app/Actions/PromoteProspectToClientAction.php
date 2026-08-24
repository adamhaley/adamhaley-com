<?php

namespace App\Actions;

use App\Enums\ProspectStatus;
use App\Models\Client;
use App\Models\Prospect;

class PromoteProspectToClientAction
{
    public function __construct(private readonly UpsertClientAction $upsertClient) {}

    public function __invoke(Prospect $prospect): Client
    {
        if ($prospect->client_id !== null) {
            return $prospect->client;
        }

        $client = ($this->upsertClient)([
            'source' => 'prospect',
            'source_external_id' => $prospect->uuid,
            'name' => $prospect->name ?: ($prospect->company ?: 'Unknown'),
            'description' => $prospect->summary,
            'email' => $prospect->email,
            'phone' => $prospect->phone,
            'url' => $prospect->website,
        ]);

        $prospect->update([
            'client_id' => $client->id,
            'status' => ProspectStatus::Converted,
        ]);

        return $client;
    }
}
