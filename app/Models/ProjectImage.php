<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectImage
 *
 * @property int $id
 * @property int $project_id
 * @property string $path
 * @property int $sort_order
 * @property-read Project $project
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'path', 'sort_order'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
