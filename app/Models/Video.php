<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable =[
        'title' ,
        'publisher' ,
        'producer' ,
        'genre' ,
        'age_rating' ,
        'file_path',
        'user_id'
    ];
    public function likes()
{
    return $this->hasMany(Like::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}
}
