@extends('admin.layouts.master')
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Add new post</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{ route('admin.blog.index') }}">Blog</a></li>
                <li class="active">Add new</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <form method="post" action="{{route('admin.blog.store')}}" enctype="multipart/form-data" id="post-form">
                {{csrf_field()}}
                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body ">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug">Excerpt</label>
                                <textarea class="form-control" name="excerpt" id="excerpt" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="slug">Body</label>
                                <textarea class="form-control" name="body" id="body"></textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Publish</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="published_at"></label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type="text" name="published_at" id="published_at" class="form-control" placeholder='Y-m-d H:i:s'>
                                    <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                <a id="draft-btn" class="btn btn-default">Save Draft</a>
                            </div>
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Category</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">

                                    @foreach($categories as $category)
                                        <input type="checkbox" name="category[]" value="{{$category->id}}"> {{$category->title}}<br>
                                    @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Feature Image</h3>
                        </div>
                        <div class="box-body text-center">
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://placehold.it/200x150&text=No+Image" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                            <input type="file" name="img"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
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

        CKEDITOR.replace( 'body' );

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            showClear: true
        });

        $('#draft-btn').click(function(e) {
            e.preventDefault();
            $('#published_at').val("");
            $('#post-form').submit();
        });
    </script>
@endsection
