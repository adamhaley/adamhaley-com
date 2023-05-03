<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class media
 *
 * @property $id
 * @property $category_id
 * @property $name
 * @property $path
 * @property $created_at
 * @property $updated_at
 *
 * @property MediaCategory $mediaCategory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Media extends Model
{

    static $rules = [
		'category_id' => 'required',
		'name' => 'required',
		'path' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','name','path'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mediaCategory()
    {
        return $this->hasOne('App\Models\MediaCategory', 'id', 'category_id');
    }


}
