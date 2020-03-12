<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>@yield('page-title')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/gif" sizes="64x64">
    <link rel="mask-icon" href="{{ asset('favicon.png') }}" color="#FFFFFF">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPIB Margamulya</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin-asset/img/favicon.png') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.0.45/css/materialdesignicons.min.css">
</head>

<body>
<div class="container-scroller">
    @include('layouts.admin.parts.header')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.admin.parts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('layouts.admin.parts.footer')
        </div>
    </div>
</div>

<script src="{{ mix('js/admin.js') }}"></script>
@yield('sweet-alert')
</body>

</html>
