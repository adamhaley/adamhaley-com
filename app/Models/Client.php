<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Client
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $source
 * @property non-empty-string|null $source_external_id
 * @property string $name
 * @property string|null $description
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $url
 * @property array<string, mixed>|null $raw_payload
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Project> $projects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Prospect> $prospects
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $perPage = 10;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'raw_payload' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Client $client): void {
            $client->uuid ??= (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Many-to-Many: A client can belong to many projects.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    public function prospects()
    {
        return $this->hasMany(Prospect::class);
    }
}
