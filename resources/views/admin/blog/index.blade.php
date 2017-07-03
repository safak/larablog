@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Posts
                <small>All Blog Posts</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('admin.index')}}">Dashboard</a></li>
                <li><i class="fa fa-edit"></i> <a href="{{route('admin.blog.index')}}">Blog</a></li>
                <li class="active">All Posts</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin.blog.create')}}"><i class="fa fa-plus-circle"></i> Add New</a><br><br>
                                @foreach($statusList as $key => $value)

                                    <a href="?status={{$key}}">{{ucwords($key)}}</a> ({{$value}}) |

                                @endforeach
                            </div>
                            <div class="pull-right">
                                <form accept-charset="utf-8" method="post" class="form-inline" id="form-filter" action="#">
                                    <div class="input-group">
                                        <input type="hidden" name="search">
                                        <input type="text" name="keywords" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search..." value="">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-default search-btn" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            @if($posts->count() == 0)
                                <div class="alert alert-danger">No Post Found!</div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <table class="table table-bordered table-condesed">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td width="70">
                                            @if($status == 'trash')
                                                <a title="Restore" class="btn btn-xs btn-default edit-row" href="{{route('admin.blog.restore', $post->id)}}">
                                                    <i class="fa fa-refresh"></i>
                                                </a>
                                                <a title="Permanently delete" onclick="return confirm('Are You Sure?')" class="btn btn-xs btn-danger delete-row" href="{{route('admin.blog.forcedelete', $post->id)}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            @else
                                                <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{route('admin.blog.edit', $post->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Delete" class="btn btn-xs btn-danger delete-row" href="{{route('admin.blog.delete', $post->id)}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->author->name}}</td>
                                        <td>
                                            @if ($post->categories)
                                                @for ($i=0; $i<$post->categories->count(); $i++)

                                                    {{$post->categories[$i]->title}} |

                                                @endfor
                                            @endif
                                        </td>
                                        <td>{{$post->created_at}} | {!! $post->publicationLabel() !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-left">
                                {{$posts->appends(Request::query())->render()}}
                            </ul>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection