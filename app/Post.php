<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
    protected $fillable=['title','excerpt','img','slug', 'published_at', 'body', 'deleted_at','author_id', 'updated_at'];
    protected $dates = ['published_at', 'deleted_at'];

    public function author(){

        return $this->hasOne('App\User','id','author_id');

    }

    public function categories(){

        return $this->belongsToMany('App\Category','post_category','post_id','category_id');

    }

    public function tags(){

        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');

    }

    public function getPublishedDateAttribute($value){

        return $this->published_at ? $this->published_at->diffForHumans() : '';

    }

    public function getCategoriesHtmlAttribute(){

        $anchors = [];
        foreach ($this->categories as $category){

            $anchors[] = '<a href="' . route('blog.category.show', $category->slug) . '">' . $category->title . '</a>';

        }

        return implode(' | ', $anchors);

    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where("published_at", "<=", Carbon::now());
    }

    public function scopeSchedule($query)
    {
        return $query->where("published_at", ">", Carbon::now());
    }

    public function scopeDraft($query)
    {
        return $query->where("published_at", "=", NULL);
    }

    public function scopeFilter($query, $term){

        if ($term){

            $query->where(function ($q) use ($term){

                $q->whereHas('author', function ($qr) use ($term){

                    $qr->where('name', 'LIKE', "%{$term}%");

                });

                $q->orWhereHas('categories', function ($qr) use ($term){

                    $qr->where('title', 'LIKE', "%{$term}%");

                });

                $q->orWhere('title', 'LIKE', "%{$term}%");
                $q->orWhere('excerpt', 'LIKE', "%{$term}%");

            });
        }

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function publicationLabel(){
        if (!$this->published_at){
            return '<span class="label label-warning">Draft</span>';
        }
        elseif ($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Schedule</span>';
        }
        else
            return '<span class="label label-success">Published</span>';

    }

}