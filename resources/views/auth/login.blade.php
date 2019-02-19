<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="GPIB Margamulya">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css', true) }}">
        <link rel="icon" href="{{ asset('favicon.png', true) }}" type="image/gif" sizes="64x64">
        <meta name="theme-color" content="rgba(0,0,0,0.5)">
    </head>
    <body>
        <div class="super_container">
            <div class="home">
                <div class="home_slider_container">
                    <div class="owl-carousel owl-theme home_slider">
                        <div class="owl-item">
                            <div class="home_slider_background" style="background-image:url(app-asset/img/background-login.jpeg)"></div>
                            <div class="container h-100">
                                <div class="row h-100 justify-content-center align-self-center">
                                    <div class="col-md-4 my-auto">
                                        <div class="login-box">
                                            <div class="login-box-body">
                                                <img src="{{ asset('app-asset/img/logo-marga-mulya-invert-black.png') }}" class="mb-4" alt="logo" />
                                                <form action="{{ route('login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="username" placeholder="Enter username" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-block">Sign In</button>
                                                    <button type="button" class="btn btn-dark btn-block" onclick="window.location.href = '{{ route('home') }}'">Home</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="{{ asset('js/home.js', true) }}"></script>
    </body>
</html>
