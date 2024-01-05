<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Maori health System">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <link rel="shortcut icon" href="{{Vite::asset(\App\Library\Enum::LOGO2_PATH)}}">
    @vite('resources/admin_assets/sass/app.scss')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    @stack('styles')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('public.components.navbar')
        <!-- partial -->
        <div class="container-fluid" style="min-height: calc(100vh - 60px);    margin-top: 60px;">
            <!-- partial -->
                @yield('content')
        </div>

        @include('admin.components.footer')
    </div>
    <!-- container-scroller -->
    <!-- <script src="{{ asset('assets/js/app-news.js') }}"></script> -->
    <script src="{{ asset('assets/js/admin.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/loadingoverlay.min.js') }}"></script>
    @vite('resources/admin_assets/js/app.js')
    @include('admin.components.flash')
    @stack('scripts')
</body>
</html>
