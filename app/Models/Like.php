<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id', 'post_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    ########################### The Relation for Likes ###############################


    //the post has many like and like belong to one post
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }


    //the user has many like and like belong to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
