<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property $id
 * @property $title
 * @property $slug
 * @property $body
 * @property $image
 * @property $tags
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    
    static $rules = [
		'title' => 'required',
		'slug' => 'required',
		'body' => 'required',
		'image' => 'required',
		'tags' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','slug','body','image','tags'];



}
