<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de alarma comunitaria - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{--Bootstrap--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    {{-- CSS--}} 
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @viteReactRefresh
    @vite(['resources/sass/app.scss'])  --}}
    {{-- Scripts --}}
    @stack('head-scripts')
</head>
<body>

    {{-- del esteban --}}
     <!-- Header -->
    {{-- @include('includes.header')
    @include('includes.menu-hamburguesa')     --}}
    @include('includes.navbar')
    @yield('body')
    <div class="container py-5">
        @yield('content')


        </div>
    </div>
    <script src="{{ asset('js/buttons.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
    @include('includes.footer') 


    
</body>
</html>