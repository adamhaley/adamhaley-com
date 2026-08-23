<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post
 *
 * @property $id
 * @property $title
 * @property $slug
 * @property $raw
 * @property $ai_draft
 * @property $ai_draft_generated_at
 * @property $body
 * @property $tags
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

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'raw', 'ai_draft', 'ai_draft_generated_at', 'body', 'tags'];

    protected function casts(): array
    {
        return [
            'ai_draft_generated_at' => 'datetime',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(PostImage::class)->orderBy('sort_order');
    }
}
