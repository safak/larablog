<div class="col-md-4">
    <aside class="right-sidebar">
        <div class="search-widget">
            <form action="{{route('blog.index')}}">

                <div class="input-group">
                    <input type="text" class="form-control input-lg" value="{{request('term')}}" name="term" placeholder="Search for...">
                    <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>

            </form>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $category)
                        <li><a href="{{route('blog.category.show', $category->slug)}}"><i class="fa fa-angle-right"></i> {{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach($popularPosts as $post)
                        <li>
                            <div class="post-image">
                                <a href="{{route('blog.show', $post->slug)}}">
                                    <img width="25px" src="storage/media/{{

                                    $post->img ? $post->img : 'no-image.jpg'

                                    }}" />
                                </a>
                            </div>
                            <div class="post-body">
                                <h6><a href="{{route('blog.show', $post->slug)}}">{{$post->title}}</a></h6>
                                <div class="post-meta">
                                    <span>36 minutes ago</span>
                                </div>
                            </div><br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    @foreach($popularTags as $tag)
                        <li><a href="{{route('blog.tag.show', $tag->tag)}}">{{$tag->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>