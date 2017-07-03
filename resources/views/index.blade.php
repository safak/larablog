@extends('layouts.master')

@section('content')
    <div class="col-md-8">
        @if($term = request('term'))
            <div class="alert alert-info">
                Search results for: <b>{{$term}}</b>
            </div>
        @endif
        @foreach($posts as $post)
            <article class="post-item">
                @if($post->img)
                    <div class="post-item-image">
                        <a href="{{$post->slug}}">
                            <img src="{{asset('storage/media/'.$post->img)}}">
                        </a>
                    </div>
                @endif
                <div class="post-item-body">
                    <div class="padding-10">
                        <h2><a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a></h2>
                        <p>{{$post->excerpt}}</p>
                    </div>

                    <div class="post-meta padding-10 clearfix">
                        <div class="pull-left">
                            <ul class="post-meta-group">
                                <li><i class="fa fa-user"></i><a href="{{route('blog.author.show', $post->author->slug)}}"> {{$post->author->name}}</a></li>
                                <li><i class="fa fa-clock-o"></i> {{$post->publishedDate}}</li>
                                <li><i class="fa fa-folder"></i>{!! $post->CategoriesHtml !!}</li>
                                <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <a href="post.html">Continue Reading &raquo;</a>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
        <nav>
            {{ $posts->appends(request()->only(['term']))->links() }}
        </nav>
    </div>
@endsection