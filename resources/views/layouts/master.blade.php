<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('page-title')</title>
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/gif" sizes="64x64">
        <link rel="mask-icon" href="{{ asset('favicon.png') }}" color="#FFFFFF">
        <meta name="theme-color" content="rgba(0,0,0,0.5)">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Demo project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if(Request::is('article/*') || Request::is('event/*') || Request::is('warta-umum/*') || Request::is('warta-jemaat/*') || Request::is('search/*'))
        <link rel="stylesheet" type="text/css" href="{{ asset('css/article.css') }}">
        @else
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        @endif
    </head>
    <body>

    <div class="super_container">
        @include('layouts.parts.header')
        @yield('content')
    	@include('layouts.parts.footer')
    </div>

    @if(Request::is('article/*') || Request::is('event/*') || Request::is('warta-umum/*') || Request::is('warta-jemaat/*') || Request::is('search/*'))
    <script src="{{ asset('js/article.js') }}"></script>
    @else
    <script src="{{ asset('js/app.js') }}"></script>
    @endif
    </body>
</html>
