@include('layouts.header')

<div class="container">
    <div class="row">

        @yield('content')

        @include('layouts.sidebar')

    </div>
</div>

@include('layouts.footer')
