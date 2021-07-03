<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'text', 'photo','created_at','updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at',
    ];


    ########################### The Relation for Posts ###############################

    //the user hase many posts and post belong to one user
    public function users()
    {
        return $this -> belongsIo('App\Models\User','user_id','id');
    }  

    //the post hase many comment and comment belong to one post
public function comments()
{
    return $this -> hasMany('App\Models\Comment','post_id','id');
}   

//the post hase many like and like belong to one post
public function likes()
{
    return $this -> hasMany('App\Models\Likes','post_id','id');
}   


}
