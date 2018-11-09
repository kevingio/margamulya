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
                            <li class="nav_item{{ Request::is('/') ? ' active' : '' }}"><a href="/">Home</a></li>
                            <li class="nav_item dropdown {{ Request::is('warta-*') || Request::is('warta-*/*') ? ' active' : '' }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Warta</a>
                                <div class="dropdown-menu navbar-dropdown" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item {{ Request::is('warta-jemaat') || Request::is('warta-jemaat/*') ? ' active' : '' }}" type="button" onclick="window.location.href = '{{ route('warta-jemaat') }}'">Jemaat</button>
                                    <button class="dropdown-item {{ Request::is('warta-umum') || Request::is('warta-umum/*') ? ' active' : '' }}" type="button" onclick="window.location.href = '{{ route('warta-umum') }}'">Umum</button>
                                </div>
                            </li>
                            <li class="nav_item{{ Request::is('article') || Request::is('article/*') ? ' active' : '' }}"><a href="{{ url('article') }}">Articles</a></li>
                            <li class="nav_item{{ Request::is('event') || Request::is('event/*') ? ' active' : '' }}"><a href="{{ url('event') }}">Events</a></li>
                            <li class="nav_item{{ Request::is('directory') || Request::is('directory/*') ? ' active' : '' }}"><a href="{{ route('directory') }}">Directory</a></li>
                            <li class="nav_item dropdown {{ Request::is('about/*') ? ' active' : '' }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
                                <div class="dropdown-menu navbar-dropdown" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item {{ Request::is('about/gpib') ? ' active' : '' }}" type="button" onclick="window.location.href = '{{ url('about/gpib') }}'">GPIB</button>
                                    <button class="dropdown-item {{ Request::is('about/gpib-margamulya') ? ' active' : '' }}" type="button" onclick="window.location.href = '{{ url('about/gpib-margamulya') }}'">GPIB Marga Mulya</button>
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
