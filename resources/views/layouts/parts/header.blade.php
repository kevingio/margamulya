<header class="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('app-asset/img/logo-marga-mulya.png') }}" class="img-logo" alt="logo">
                        </a>
                    </div>
                    <nav class="main_nav">
                        <ul>
                            <li class="nav_item{{ request()->is('/') ? ' active' : '' }}"><a href="/">Home</a></li>
                            <li class="nav_item{{ request()->is('warta') || request()->is('warta/*') ? ' active' : '' }}"><a href="{{ url('warta') }}">Warta</a></li>
                            <li class="nav_item{{ request()->is('article') || request()->is('article/*') ? ' active' : '' }}"><a href="{{ url('article') }}">Articles</a></li>
                            <li class="nav_item{{ request()->is('event') || request()->is('event/*') ? ' active' : '' }}"><a href="{{ url('event') }}">Events</a></li>
                            <li class="nav_item{{ request()->is('directory') || request()->is('directory/*') ? ' active' : '' }}"><a href="{{ route('directory') }}">Directory</a></li>
                            <li class="nav_item dropdown {{ request()->is('about/*') ? ' active' : '' }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
                                <div class="dropdown-menu navbar-dropdown" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item {{ request()->is('about/gpib') ? ' active' : '' }}" type="button" onclick="window.location.href = '{{ url('about/gpib') }}'">GPIB</button>
                                    <button class="dropdown-item {{ request()->is('about/gpib-margamulya') ? ' active' : '' }}" type="button" onclick="window.location.href = '{{ url('about/gpib-margamulya') }}'">GPIB Marga Mulya</button>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="search_container ml-auto">
                        <input type="search" class="header_search_input search-box" autocomplete="off" required="required" placeholder="Type to Search...">
                        <img class="header_search_icon" src="{{ asset('app-asset/img/search.png') }}" alt="search-icon">

                    </div>
                    <div class="hamburger ml-auto menu_mm">
                        <i class="fa fa-bars trans_200 menu_mm" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@include('layouts.parts.navbar-mobile')
