<!doctype html>
<html lang="en">

<head>
    @include('frontend.layouts.app_head')
</head>


<body class="bg-white text-dark" style="margin-top: 120px">

    @include('frontend.layouts.app_navbar')

    <div class="container">
        @yield('konten')
    </div>

    @include('frontend.layouts.app_footer')


    @include('frontend.layouts.app_script')
</body>

</html>
