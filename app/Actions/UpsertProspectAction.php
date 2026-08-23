<?php

namespace App\Actions;

use App\Models\Prospect;

class UpsertProspectAction
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function __invoke(array $data): Prospect
    {
        $data['raw_payload'] ??= $data;

        // Only dedupe when the source actually supplies a stable external id
        // (e.g. an Upwork job id). Sources without one (e.g. one-off field
        // report captures) should always create a new row — matching on a
        // shared null external_id would otherwise merge unrelated prospects.
        // Don't inject a default 'status' into $data here: on the update
        // path that would silently reset an already-progressed prospect
        // (e.g. manually marked 'qualified') back to 'new' on every re-sync.
        if (empty($data['source_external_id'])) {
            $prospect = Prospect::create($data);
        } else {
            $prospect = Prospect::updateOrCreate(
                [
                    'source' => $data['source'],
                    'source_external_id' => $data['source_external_id'],
                ],
                $data,
            );
        }

        // A freshly written model's in-memory attributes don't reflect
        // DB-level defaults (e.g. status) until refreshed.
        return $prospect->refresh();
    }
}
