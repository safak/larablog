<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Tag extends Model
{

    protected $fillable = ['title', 'tag'];

    public function posts(){

        return $this->belongsToMany('App\Post','post_tag','tag_id','post_id');

    }

    public function scopePopular($query){

        return $query->withCount('posts')->OrderBy('posts_count','desc');

    }

    public function getRouteKeyName()
    {
        return 'tag';
    }
}
