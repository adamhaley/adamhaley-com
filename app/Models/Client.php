<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $email
 * @property $phone
 * @property $address
 * @property $url
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Client extends Model
{

    static $rules = [
		'name' => 'required',
		'description' => 'required',
		'email' => 'required',
		'phone' => 'required',
		'address' => 'required',
		'url' => 'required',
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','email','phone','address','url'];



}
