<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('page-title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/gif" sizes="64x64">
        <link rel="mask-icon" href="{{ asset('favicon.png') }}" color="#FFFFFF">
        <meta name="theme-color" content="rgba(0,0,0,0.5)">
        <meta name="description" content="Demo project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    </head>
    <body>

    <div class="super_container">
        @include('layouts.parts.header')
        @yield('content')
    	@include('layouts.parts.footer')
    </div>

    <script src="{{ asset('js/home.js') }}"></script>
    </body>
</html>
