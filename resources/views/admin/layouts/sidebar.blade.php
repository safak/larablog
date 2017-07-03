<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('storage/admin_folder/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <?php $CurrentUser = Auth::user() ?>
            <div class="pull-left info">
                <p>{{$CurrentUser->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{route('admin.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.blog.index')}}"><i class="fa fa-circle-o"></i> All Posts</a></li>
                    <li><a href="{{route('admin.blog.create')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            @role(['admin','editor'])
            <li><a href="{{route('admin.category.index')}}"><i class="fa fa-folder"></i> <span>Categories</span></a></li>
            <li><a href="{{route('admin.tag.index')}}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
            @endrole
            @role('admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>User</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.user.index')}}"><i class="fa fa-circle-o"></i> All Users</a></li>
                    <li><a href="{{route('admin.user.create')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            @endrole
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>