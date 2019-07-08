<?php

namespace App\Models;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'thumbnail_path',
        'status',
    ];
    protected $dates = [
        'created_at'
    ];

    protected $dispatchesEvents = [
        'created' =>PostCreated::class,
        'updated' => PostUpdated::class,
        'deleted' => PostDeleted::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * The event map for the model.
     *
     * @var array
     */
//    protected $dispatchesEvents = [
//        'created' => PostCreated::class,
//        'updated' => PostUpdated::class,
//        'deleted' => PostDeleted::class,
//    ];
}
