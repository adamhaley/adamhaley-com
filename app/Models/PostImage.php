<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PostImage
 *
 * @property int $id
 * @property int $post_id
 * @property string $path
 * @property int $sort_order
 * @property-read Post $post
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PostImage extends Model
{
    protected $fillable = ['post_id', 'path', 'sort_order'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
