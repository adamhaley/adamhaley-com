<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MediaCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Medium[] $media
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MediaCategory extends Model
{

    static $rules = [
		'name' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function media()
    {
        return $this->hasMany('App\Models\Medium', 'category_id', 'id');
    }


}
