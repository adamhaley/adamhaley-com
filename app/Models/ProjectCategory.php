<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 * @property $parent_id
 *
 * @property ProjectCategory[] $projectCategories
 * @property ProjectCategory $projectCategory
 * @property Project[] $projects
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectCategory extends Model
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
    protected $fillable = ['name','description','parent_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectCategories()
    {
        return $this->hasMany('App\Models\ProjectCategory', 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectCategory()
    {
        return $this->hasOne('App\Models\ProjectCategory', 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'category_id', 'id');
    }


}
