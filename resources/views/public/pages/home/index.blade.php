<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Maori health System">
    <meta name="author" content="">

    <title>@yield('title', 'Home Page')</title>
    <link rel="shortcut icon" href="{{ settings('favicon') ? asset(settings('favicon')) : Vite::asset(\App\Library\Enum::NO_IMAGE_PATH) }}">
    @stack('styles')
</head>

<body>
    <h3>Welcome to public site.</h3>
    @stack('scripts')
</body>
</html>
