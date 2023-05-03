<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 *
 * @property $id
 * @property $category_id
 * @property $name
 * @property $description
 * @property $image
 * @property $link
 * @property $github
 * @property $tags
 * @property $date
 * @property $created_at
 * @property $updated_at
 *
 * @property ProjectCategory $projectCategory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model
{

    static $rules = [
		'category_id' => 'required',
		'name' => 'required',
		'description' => 'required',
		'image' => 'required',
		'link' => 'required',
		'github' => 'required',
		'tags' => 'required',
		'date' => 'required',
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','name','description','image','link','github','tags','date'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectCategory()
    {
        return $this->hasOne('App\Models\ProjectCategory', 'id', 'category_id');
    }


}
