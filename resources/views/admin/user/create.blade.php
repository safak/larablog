@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Create New User</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('admin.index')}}">Dashboard</a></li>
                <li><i class="fa fa-edit"></i> <a href="{{route('admin.user.index')}}">User</a></li>
                <li class="active">New User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            <div class="col-xs-4">

                                <form action="{{route('admin.user.store')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" required="required" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Slug</label>
                                        <input type="text" id="slug" name="slug" required="required|unique:users,slug" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">E-mail</label>
                                        <input type="email" id="email" name="email" required="required|email|unique:users,email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Password</label>
                                        <input type="password" id="password" name="password" required="required|min:6|confirmed" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Password (Again)</label>
                                        <input type="password" id="confirm_password" name="confirm_password" required="required|same:password|min:6" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Role</label>
                                        <select name="role" id="role">
                                            <option value="5">Admin</option>
                                            <option value="6">Editor</option>
                                            <option selected value="7">Author</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Bio</label><br>
                                        <textarea name="bio" id="bio" cols="57" rows="7"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Create" class="btn btn-primary">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
<script>
    var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    $('#name').on('blur', function() {
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