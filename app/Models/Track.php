<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'title',
        'file',
        'album_id',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
