@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category
                <small>All Categories</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('admin.index')}}">Dashboard</a></li>
                <li><i class="fa fa-edit"></i> <a href="{{route('admin.category.index')}}">Categories</a></li>
                <li class="active">All Categories</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-4">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <h4>Add New Category</h4><br>
                            <form action="{{route('admin.category.store')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input type="text" id="slug" name="slug" required="required" class="form-control">
                                </div>
                                <div class="form-group pull-right col-xs-4">
                                    <input type="submit" name="submit" value="Create" required="required" class="form-control btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-xs-8">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-condesed">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Count</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td width="70">
                                                <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{route('admin.category.edit', $category->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Delete" onclick="return confirm('Are You Sure?')" class="btn btn-xs btn-danger delete-row" href="{{route('admin.category.delete', $category->id)}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                        </td>
                                        <td>{{$category->title}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td><a href="{{route('admin.blog.index', 'categoryId='.$category->id)}}">{{$category->posts->count()}}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-left">
                                {{$categories->appends(Request::query())->render()}}
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
@section('js')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');

        $('#title').on('blur', function() {
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                    .replace(/İ/g, 'i')
                    .replace(/ş/g, 's')
                    .replace(/ğ/g, 'g')
                    .replace(/ı/g, 'i')
                    .replace(/ç/g, 'c')
                    .replace(/ö/g, 'o')
                    .replace(/ü/g, 'u')
                    .replace(/Ü/g, 'u')
                    .replace(/Ç/g, 'c')
                    .replace(/Ö/g, 'o')
                    .replace(/Ğ/g, 'g')
                    .replace(/Ş/g, 's')
                    .replace(/[^a-z0-9-]+/g, '-')
                    .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });
    </script>
@endsection