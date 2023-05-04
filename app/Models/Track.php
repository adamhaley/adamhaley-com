<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Track
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $image
 * @property $lyrics
 * @property $album_id
 * @property $order
 * @property $file
 * @property $created_at
 * @property $updated_at
 *
 * @property Album $album
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Track extends Model
{

    static $rules = [
		'name' => 'required',
		'description' => 'required',
		'image' => 'required',
		'lyrics' => 'required',
		'album_id' => 'required',
		'order' => 'required',
		'file' => 'required',
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','image','lyrics','album_id','order','file'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function album()
    {
        return $this->hasOne('App\Models\Album', 'id', 'album_id');
    }


}
