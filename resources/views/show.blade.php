@extends('layouts.master')
@section('content')
<div class="col-md-8">
    <article class="post-item post-detail">
        @if($post->img)
            <div class="post-item-image">
                <a href="#">
                    <img src="storage/media/{{$post->img}}">
                </a>
            </div>
        @endif
        <div class="post-item-body">
            <div class="padding-10">
                <h1>{{$post->title}}</h1>

                <div class="post-meta no-border">
                    <ul class="post-meta-group">
                        <li><i class="fa fa-user"></i><a href="{{route('blog.author.show', $post->author->slug)}}"> {{$post->author->name}}</a></li>
                        <li><i class="fa fa-clock-o"></i><time> {{$post->publishedDate}}</time></li>
                        <li><i class="fa fa-folder"></i>{!! $post->CategoriesHtml !!}</li>
                        <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                </div>

                {!! $post->body !!}
            </div>
        </div>
    </article>

    <article class="post-author padding-10">
                <h4 class="media-heading">Tags</h4>
                <ul class="tags">
                    @if ($post->tags)
                        @for ($i=0; $i<$post->tags->count(); $i++)

                            <li><a href="{{route('blog.tag.show', $post->tags[$i]->tag)}}">{{$post->tags[$i]->title}}</a></li>

                        @endfor
                    @endif
                </ul>
    </article>

    <article class="post-author padding-10">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img alt="Author 1" src="img/author.jpg" class="media-object">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><a href="{{route('blog.author.show', $post->author->slug)}}">{{$post->author->name}}</a></h4>
                <div class="post-author-count">
                    <a href="{{route('blog.author.show', $post->author->slug)}}">
                        <i class="fa fa-clone"></i>
                        {{$post->author->posts()->count()}}
                    </a>
                </div>
                {{$post->author->bio}}
            </div>
        </div>
    </article>

    <article class="post-comments">
        <h3><i class="fa fa-comments"></i> 5 Comments</h3>

        <div class="comment-body padding-10">
            <ul class="comments-list">
                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>John Doe <small>January 14, 2016</small></h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est, atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam ipsam perspiciatis assumenda magnam doloribus!</p>
                        <p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit explicabo, non molestias aliquid quibusdam tempore. Vel.</p>
                    </div>
                </li>

                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>John Doe <small>January 14, 2016</small></h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est, atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam ipsam perspiciatis assumenda magnam doloribus!</p>
                        <p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit explicabo, non molestias aliquid quibusdam tempore. Vel.</p>

                        <ul class="comments-list-children">
                            <li class="comment-item">
                                <div class="comment-heading clearfix">
                                    <div class="comment-author-meta">
                                        <h4>John Doe <small>January 14, 2016</small></h4>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est, atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam ipsam perspiciatis assumenda magnam doloribus!</p>
                                    <p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit explicabo, non molestias aliquid quibusdam tempore. Vel.</p>
                                </div>
                            </li>

                            <li class="comment-item">
                                <div class="comment-heading clearfix">
                                    <div class="comment-author-meta">
                                        <h4>John Doe <small>January 14, 2016</small></h4>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est, atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam ipsam perspiciatis assumenda magnam doloribus!</p>
                                    <p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit explicabo, non molestias aliquid quibusdam tempore. Vel.</p>

                                    <ul class="comments-list-children">
                                        <li class="comment-item">
                                            <div class="comment-heading clearfix">
                                                <div class="comment-author-meta">
                                                    <h4>John Doe <small>January 14, 2016</small></h4>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est, atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam ipsam perspiciatis assumenda magnam doloribus!</p>
                                                <p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit explicabo, non molestias aliquid quibusdam tempore. Vel.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>

        <div class="comment-footer padding-10">
            <h3>Leave a comment</h3>
            <form>
                <div class="form-group required">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group required">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" class="form-control">
                </div>
                <div class="form-group required">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="6" class="form-control"></textarea>
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </div>
                    <div class="pull-right">
                        <p class="text-muted">
                            <span class="required">*</span>
                            <em>Indicates required fields</em>
                        </p>
                    </div>
                </div>
            </form>
        </div>

    </article>
</div>
@endsection