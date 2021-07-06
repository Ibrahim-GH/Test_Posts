<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'user_id', 'post_id', 'photo',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    ########################### The Relation for Comments ###############################

    //the post has many comment and comment belong to one post
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    //the user has many comment and comment belong to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
