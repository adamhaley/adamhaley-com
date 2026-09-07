<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Post
 *
 * @property $id
 * @property string $uuid
 * @property string|null $source
 * @property non-empty-string|null $source_external_id
 * @property $title
 * @property $slug
 * @property $raw
 * @property $ai_draft
 * @property $ai_draft_generated_at
 * @property $body
 * @property $tags
 * @property array<string, mixed>|null $raw_payload
 * @property $created_at
 * @property $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PostImage> $images
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    use HasFactory;

    protected $perPage = 10;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'ai_draft_generated_at' => 'datetime',
            'raw_payload' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post): void {
            $post->uuid ??= (string) Str::uuid();
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(PostImage::class)->orderBy('sort_order');
    }
}
