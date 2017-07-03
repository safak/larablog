@extends('admin.layouts.master')
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tag
                <small>Edit this tag</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{ route('admin.tag.index') }}">tag</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form method="post" action="{{route('admin.tag.update', $tag->id)}}" id="post-form">
                                {{csrf_field()}}
                                <div class="form-group col-xs-4">
                                    <label for="title">Title</label>
                                    <input type="text" value="{{$tag->title}}" id="title" name="title" required="required" class="form-control">
                                </div>
                                <div class="form-group col-xs-4">
                                    <label for="slug">Slug</label>
                                    <input type="text" value="{{$tag->tag}}" id="slug" name="tag" required="required" class="form-control">
                                </div>
                                <div style="margin-top: 24px" class="form-group col-xs-2 ">
                                    <input type="submit" value="Edit" name="submit" class="form-control btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                </form>
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
