@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body ">
                            <h3>Welcome to Admin Panel</h3>
                            <p class="lead text-muted">Hello User, Welcome to dashboard. This is <a href="http://safak.co">v1.1</a></p>
                            <h4>What's new</h4>
                            <ul>
                                <li>Crud operations completed</li>
                                <li>Category and label assignments completed</li>
                                <li>User profile is now complete</li>
                            </ul>
                            <p class="lead text-muted">Enjoy it!</p>
                            <h4>Get started</h4>
                            <p><a href="{{route('admin.blog.create')}}" class="btn btn-primary">Write your first blog post</a> </p>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection