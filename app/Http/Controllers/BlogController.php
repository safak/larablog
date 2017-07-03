<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit=5;

    public function index(){

        $posts=Post::with('author','categories','tags')
            ->Latest()
            ->Published()
            ->filter(request('term'))
            ->simplepaginate($this->limit);

        return view('index', compact('posts'));

    }

    public function show(Post $post){

        $post->increment('view_count');

        return view("show", compact('post'));

    }

    public function category(Category $category){

        $posts=$category->posts()
            ->with('author','tags')
            ->Published()
            ->Latest()
            ->simplepaginate($this->limit);

        return view("index", compact('posts'));

    }

    public function tag(Tag $tag){

        $posts=$tag->posts()
            ->with('author','categories')
            ->Published()
            ->Latest()
            ->simplepaginate($this->limit);

        return view("index", compact('posts'));

    }

    public function author(User $author){

        $posts=$author->posts()
            ->with('categories','tags')
            ->Published()
            ->Latest()
            ->simplepaginate($this->limit);

        return view("index", compact('posts'));

    }
}
