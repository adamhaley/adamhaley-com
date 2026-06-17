<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class ExportContent extends Command
{
    protected $signature = 'content:export
        {path : Destination JSON file path}
        {--project=* : Limit export to specific project IDs}
        {--client=* : Limit export to specific client IDs}';

    protected $description = 'Export projects, clients, and their relationships to a JSON file';

    public function handle(): int
    {
        $path = $this->argument('path');
        $projectIds = collect($this->option('project'))->filter()->map(fn ($id) => (int) $id);
        $clientIds = collect($this->option('client'))->filter()->map(fn ($id) => (int) $id);

        $projects = $projectIds->isNotEmpty()
            ? Project::query()->with('clients')->whereIn('id', $projectIds)->orderBy('id')->get()
            : ($clientIds->isEmpty()
                ? Project::query()->with('clients')->orderBy('id')->get()
                : collect());

        $clients = $clientIds->isNotEmpty()
            ? Client::query()->with('projects')->whereIn('id', $clientIds)->orderBy('id')->get()
            : ($projectIds->isEmpty()
                ? Client::query()->with('projects')->orderBy('id')->get()
                : collect());

        if ($projectIds->isNotEmpty()) {
            $relatedClientIds = $projects->pluck('clients')->flatten()->pluck('id');
            $clients = $clients->merge(
                Client::query()->whereIn('id', $relatedClientIds)->get()
            )->unique('id')->values();
        }

        if ($clientIds->isNotEmpty()) {
            $relatedProjects = $clients->pluck('projects')->flatten();
            $projects = $projects->merge($relatedProjects)->unique('id')->values();

            $relatedClientIds = $projects->pluck('clients')->flatten()->pluck('id');
            $clients = $clients->merge(
                Client::query()->whereIn('id', $relatedClientIds)->get()
            )->unique('id')->values();
        }

        $projects = $projects->loadMissing('clients');
        $clients = $clients->loadMissing('projects');

        $payload = [
            'schema_version' => 1,
            'exported_at' => now()->toIso8601String(),
            'projects' => $projects->map(fn (Project $project) => [
                'id' => $project->id,
                'name' => $project->name,
                'category_id' => $project->category_id,
                'description' => $project->description,
                'image' => $project->image,
                'link' => $project->link,
                'github' => $project->github,
                'tags' => $project->tags,
                'date' => (string) $project->date,
                'client_emails' => $project->clients
                    ->pluck('email')
                    ->filter()
                    ->sort()
                    ->values()
                    ->all(),
            ])->values()->all(),
            'clients' => $clients->map(fn (Client $client) => [
                'id' => $client->id,
                'name' => $client->name,
                'description' => $client->description,
                'email' => $client->email,
                'phone' => $client->phone,
                'address' => $client->address,
                'url' => $client->url,
            ])->values()->all(),
            'assets' => [
                'public' => [
                    'projects' => $this->buildProjectAssetManifest($projects)->all(),
                ],
            ],
        ];

        $directory = dirname($path);

        if (! is_dir($directory)) {
            File::ensureDirectoryExists($directory);
        }

        File::put($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).PHP_EOL);

        $this->info("Exported {$projects->count()} projects and {$clients->count()} clients to {$path}");

        return self::SUCCESS;
    }

    protected function buildProjectAssetManifest(Collection $projects): Collection
    {
        return $projects
            ->pluck('image')
            ->filter(fn ($path) => is_string($path) && $path !== '')
            ->unique()
            ->values();
    }
}
