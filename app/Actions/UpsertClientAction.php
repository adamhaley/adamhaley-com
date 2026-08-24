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

            return $client->refresh();
        }

        $client = Client::firstOrNew([
            'source' => $data['source'],
            'source_external_id' => $data['source_external_id'],
        ]);

        if ($client->exists) {
            // The CRM is the source of truth once a client exists here: an
            // import only fills fields the CRM doesn't already have a value
            // for, it never overwrites one, even if the import's value has
            // since changed. raw_payload is exempt - it's a debug snapshot
            // of the last import call, not user-facing CRM data.
            foreach ($data as $key => $value) {
                if ($key !== 'raw_payload' && blank($client->{$key})) {
                    $client->{$key} = $value;
                }
            }
            $client->raw_payload = $data['raw_payload'];
        } else {
            $client->fill($data);
        }

        $client->save();

        return $client->refresh();
    }
}
