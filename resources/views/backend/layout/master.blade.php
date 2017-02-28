<!DOCTYPE html>
<html lang="en">

@include('backend.layout.head')

<body>

<div id="wrapper">

    <!-- Navigation -->
@include('backend.layout.navigation')

    <div id="page-wrapper">

        <div class="container-fluid">
            @yield('content')
        </div>

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="storage/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="storage/js/bootstrap.min.js"></script>

@yield('js')

</body>

</html>
