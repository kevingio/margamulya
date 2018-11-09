<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('admin/') }}">
            <img src="{{ asset('app-asset/img/logo-marga-mulya-invert-black.png') }}" class="img-logo" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('admin') }}">
            <img src="{{ asset('favicon.png')}}" alt="logo"/>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        @if(Request::is('admin/gallery/*/*') || Request::is('admin/article/*'))
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item">
                <a href="javascript: history.back()" class="nav-link">
                    <i class="mdi mdi-keyboard-backspace"></i>
                    Back
                </a>
            </li>
        </ul>
        @endif
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <span class="profile-text d-none d-lg-inline-block">Hello, {{ Auth::user()->name }} !</span>
                    <img class="img-xs rounded-circle" src="{{ asset('admin-asset/img/faces/face1.jpg') }}" alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item" href="{{ url('/admin/profile', [Auth::user()->id]) }}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('change-password') }}">
                        Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign Out
                        <form action="{{ route('logout') }}" method="post" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
