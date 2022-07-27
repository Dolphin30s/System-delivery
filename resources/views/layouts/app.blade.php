<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset(mix('assets/main/js/app.js')) }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/main.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/iconfont.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/material-icons/material-icons.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/vuesax.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/prism-tomorrow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/vue-tel-input.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/main/css/app.css')) }}">
</head>
<body>
    @yield('content')
</body>
</html>
