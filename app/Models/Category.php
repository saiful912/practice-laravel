<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

//    something problem relation
//    public function posts()
//    {
//        return $this->hasMany(Post::class);
//    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
