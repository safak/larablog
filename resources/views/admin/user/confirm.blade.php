@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Delete User</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('admin.index')}}">Dashboard</a></li>
                <li><i class="fa fa-edit"></i> <a href="{{route('admin.user.index')}}">User</a></li>
                <li class="active">Delete</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <p>What should be done with content own by this user?</p>
                    <form action="{{route('admin.user.delete', $id)}}", method="get">
                    {{csrf_field()}}

                        <div class="form-group">
                            <input type="radio" name="delete_option" checked value="delete"> Delete all content
                        </div>
                        <div class="form-group">
                            <input type="radio" name="delete_option" value="attribute"> Attribute content to
                            <select name="selected_user">
                                @foreach($users as $user)
                                    <option name="selected_user" value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Delete">
                        </div>

                    </form>

                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection