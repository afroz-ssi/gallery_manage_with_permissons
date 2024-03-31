@include('layouts.top_header')


<body>

    <div class="main-wrapper">
        @include('layouts.sidebar')
        @yield('content')
    </div>
    @include('layouts.footer')

</body>

</html>
