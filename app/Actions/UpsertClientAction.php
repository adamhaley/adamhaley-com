<?php

namespace App\Actions;

use App\Models\Client;

class UpsertClientAction
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function __invoke(array $data): Client
    {
        $data['raw_payload'] ??= $data;

        // Only dedupe when the source actually supplies a stable external id
        // (e.g. an accounting system's client id). Sources without one should
        // always create a new row - matching on a shared null external_id
        // would otherwise merge unrelated clients.
        if (empty($data['source_external_id'])) {
            $client = Client::create($data);
        } else {
            $client = Client::updateOrCreate(
                [
                    'source' => $data['source'],
                    'source_external_id' => $data['source_external_id'],
                ],
                $data,
            );
        }

        return $client->refresh();
    }
}
