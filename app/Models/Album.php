<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Album
 *
 * @property $id
 * @property $name
 * @property $cover_art
 * @property $release_date
 * @property $created_at
 * @property $updated_at
 * @property $description
 *
 * @property Track[] $tracks
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Album extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','cover_art','release_date','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks()
    {
        return $this->hasMany('App\Models\Track', 'album_id', 'id');
    }
    

}
