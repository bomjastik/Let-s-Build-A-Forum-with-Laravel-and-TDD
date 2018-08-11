<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-B/E/KxBX31kY/5sew+X4c8e6ErosbqOOsA3t4k6VVmx8Hrz//v0tEUtXmUVx9X6Q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/light.css" integrity="sha384-pcDR01P1wNxsYZiEYdROCAYhU2u8VHOctLrYRonRFtkf/TGEQFWt0rqFbPGWlyn4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-4eP+1rYQmuI3hxrmyE+GT/EIiNbF4R85ciN3jMpmIh+bU5Hz2IU7AdcVe+JS+AJz" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('layouts.nav')

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
