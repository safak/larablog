@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>All Users</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('admin.index')}}">Dashboard</a></li>
                <li><i class="fa fa-edit"></i> <a href="{{route('admin.user.index')}}">User</a></li>
                <li class="active">All Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin.user.create')}}"><i class="fa fa-plus-circle"></i> Add New</a><br><br>
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
                            @if($users->count() == 0)
                                <div class="alert alert-danger">No User Found!</div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                                @if (session('error-message'))
                                    <div class="alert alert-danger">
                                        {{ session('error-message') }}
                                    </div>
                                @endif
                            <table class="table table-bordered table-condesed">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Mail</th>
                                    <th>Role</th>
                                    <th>Blogs</th>
                                    <th>Created Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td width="70">
                                                <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{route('admin.user.edit', $user->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Delete" class="btn btn-xs btn-danger delete-row" href="{{route('admin.user.deleteConfirm', $user->id)}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->roles->first()->display_name}}</td>
                                        <td><a href="{{route('admin.blog.index', 'userId='.$user->id)}}">{{$user->posts->count()}}</a></td>
                                        <td>{{$user->created_at}} | {!! $user->roleLabel() !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-left">
                                {{$users->appends(Request::query())->render()}}
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