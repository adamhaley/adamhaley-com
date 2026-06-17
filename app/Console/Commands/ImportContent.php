<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class ImportContent extends Command
{
    protected $signature = 'content:import
        {path : Source JSON file path}
        {--dry-run : Validate and simulate the import without saving changes}';

    protected $description = 'Import projects, clients, and their relationships from a JSON file';

    public function handle(): int
    {
        $path = $this->argument('path');

        if (! File::exists($path)) {
            $this->error("File not found: {$path}");

            return self::FAILURE;
        }

        try {
            $payload = $this->loadPayload($path);
        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }

            return self::FAILURE;
        }

        $dryRun = (bool) $this->option('dry-run');
        $clientMap = [];
        $projectMap = [];
        $summary = [
            'clients_created' => 0,
            'clients_updated' => 0,
            'projects_created' => 0,
            'projects_updated' => 0,
            'relationships_synced' => 0,
        ];

        DB::beginTransaction();

        try {
            foreach ($payload['clients'] as $clientData) {
                $client = Client::query()->firstWhere('email', $clientData['email']);

                if ($client) {
                    $client->fill($clientData);
                    $client->save();
                    $summary['clients_updated']++;
                } else {
                    $client = Client::query()->create($clientData);
                    $summary['clients_created']++;
                }

                $clientMap[$client->email] = $client;
            }

            foreach ($payload['projects'] as $projectData) {
                $clientEmails = $projectData['client_emails'] ?? [];
                unset($projectData['client_emails']);

                $project = Project::query()->firstWhere('link', $projectData['link']);

                if ($project) {
                    $project->fill($projectData);
                    $project->save();
                    $summary['projects_updated']++;
                } else {
                    $project = Project::query()->create($projectData);
                    $summary['projects_created']++;
                }

                $projectMap[$project->link] = [
                    'model' => $project,
                    'client_emails' => $clientEmails,
                ];
            }

            foreach ($projectMap as $entry) {
                $clientIds = collect($entry['client_emails'])
                    ->map(function (string $email) use ($clientMap) {
                        if (! isset($clientMap[$email])) {
                            throw ValidationException::withMessages([
                                'projects' => "Missing imported client for email [{$email}].",
                            ]);
                        }

                        return $clientMap[$email]->id;
                    })
                    ->values()
                    ->all();

                $entry['model']->clients()->sync($clientIds);
                $summary['relationships_synced']++;
            }

            if ($dryRun) {
                DB::rollBack();
                $this->warn('Dry run complete. No changes were saved.');
            } else {
                DB::commit();
                $this->info('Import complete.');
            }
        } catch (ValidationException $exception) {
            DB::rollBack();

            foreach ($exception->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }

            return self::FAILURE;
        } catch (\Throwable $exception) {
            DB::rollBack();
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        $this->table(
            ['Metric', 'Count'],
            [
                ['Clients created', $summary['clients_created']],
                ['Clients updated', $summary['clients_updated']],
                ['Projects created', $summary['projects_created']],
                ['Projects updated', $summary['projects_updated']],
                ['Project/client syncs', $summary['relationships_synced']],
            ]
        );

        return self::SUCCESS;
    }

    /**
     * @return array{schema_version:int,clients:array<int,array<string,mixed>>,projects:array<int,array<string,mixed>>}
     */
    protected function loadPayload(string $path): array
    {
        $payload = json_decode(File::get($path), true);

        if (! is_array($payload)) {
            throw ValidationException::withMessages([
                'file' => 'The import file must contain a valid JSON object.',
            ]);
        }

        if (($payload['schema_version'] ?? null) !== 1) {
            throw ValidationException::withMessages([
                'schema_version' => 'Unsupported content export schema version.',
            ]);
        }

        if (! isset($payload['clients']) || ! is_array($payload['clients'])) {
            throw ValidationException::withMessages([
                'clients' => 'The import file is missing a valid clients array.',
            ]);
        }

        if (! isset($payload['projects']) || ! is_array($payload['projects'])) {
            throw ValidationException::withMessages([
                'projects' => 'The import file is missing a valid projects array.',
            ]);
        }

        foreach ($payload['clients'] as $index => $client) {
            foreach (['name', 'description', 'email', 'phone', 'address', 'url'] as $field) {
                if (! array_key_exists($field, $client) || blank($client[$field])) {
                    throw ValidationException::withMessages([
                        'clients' => "Client at index {$index} is missing required field [{$field}].",
                    ]);
                }
            }
        }

        foreach ($payload['projects'] as $index => $project) {
            foreach (['category_id', 'name', 'description', 'image', 'link', 'github', 'tags', 'date'] as $field) {
                if (! array_key_exists($field, $project) || blank($project[$field])) {
                    throw ValidationException::withMessages([
                        'projects' => "Project at index {$index} is missing required field [{$field}].",
                    ]);
                }
            }

            if (! isset($project['client_emails']) || ! is_array($project['client_emails'])) {
                throw ValidationException::withMessages([
                    'projects' => "Project at index {$index} is missing a valid client_emails array.",
                ]);
            }
        }

        return $payload;
    }
}
