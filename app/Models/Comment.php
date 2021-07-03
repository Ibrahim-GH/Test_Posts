<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'id', 'text','user_id','post_id','photo','created_at','updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at',
    ];
    use HasFactory;

    ########################### The Relation for Comments ###############################

//the post hase many comment and comment belong to one post
    public function posts()
    {
        return $this -> belongsTo('App\Models\Post' , 'post_id' , 'id');
    }


    //the user hase many comment and comment belong to one user
    public function users()
    {
        return $this -> belongsTo('App\Models\User' , 'user_id' , 'id');
    }

}
