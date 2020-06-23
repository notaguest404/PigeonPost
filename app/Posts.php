<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{


    protected $fillable = [
        'user_id', 'title', 'description', 'postpic'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
    * Stream: Change activity verb to 'created':
    */
    public function activityVerb()
    {
        return 'created';
    }

    public function getImageAttribute()
    {
        return $this->postpic;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'commentable_id');
    }
}
