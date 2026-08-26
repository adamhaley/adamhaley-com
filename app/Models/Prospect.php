<?php

namespace App\Models;

use App\Enums\ProspectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Prospect
 *
 * @property int $id
 * @property string $uuid
 * @property string $source
 * @property non-empty-string|null $source_external_id
 * @property string|null $name
 * @property string|null $company
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $website
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $summary
 * @property ProspectStatus $status
 * @property array<string, mixed>|null $raw_payload
 * @property int|null $client_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Client|null $client
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prospect extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => ProspectStatus::class,
            'raw_payload' => 'array',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Prospect $prospect): void {
            $prospect->uuid ??= (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function markStatus(ProspectStatus $status): bool
    {
        return $this->update(['status' => $status]);
    }

    public function markViewedIfNew(): bool
    {
        if ($this->status !== ProspectStatus::New) {
            return false;
        }

        return $this->markStatus(ProspectStatus::Viewed);
    }
}
