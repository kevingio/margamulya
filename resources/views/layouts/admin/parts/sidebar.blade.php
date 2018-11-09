<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset('admin-asset/img/faces/face1.jpg') }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name font-weight-bold">{{ Auth::user()->name }}</p>
                        <div>
                            <small class="designation text-muted">Administrator</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                <a class="btn btn-success btn-block" href="{{ route('new-article') }}">
                    <i class="mdi mdi-plus"></i>
                    Create Article
                </a>
            </div>
        </li>
        <li class="nav-item{{ Request::is('admin') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item{{ Request::is('admin/article') || Request::is('admin/article/*') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/article') }}">
                <i class="menu-icon mdi mdi-clipboard-text"></i>
                <span class="menu-title">Articles</span>
            </a>
        </li>
        <li class="nav-item{{ Request::is('admin/jemaat') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/jemaat') }}">
                <i class="menu-icon mdi mdi-account-outline"></i>
                <span class="menu-title">Jemaat</span>
            </a>
        </li>
        <li class="nav-item{{ Request::is('admin/gallery/*') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#sd-dropdown-gallery" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-collage"></i>
                <span class="menu-title">Gallery</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sd-dropdown-gallery">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link{{ Request::is('admin/gallery/photo') ? ' active' : '' }}" href="{{ url('/admin/gallery/photo') }}">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ Request::is('admin/gallery/video') ? ' active' : '' }}" href="{{ url('/admin/gallery/video') }}">Video</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item{{ Request::is('admin/warta/*') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#sd-dropdown-warta" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-telegram"></i>
                <span class="menu-title">Warta</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sd-dropdown-warta">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link{{ Request::is('admin/warta/umum') ? ' active' : '' }}" href="{{ url('/admin/warta/umum') }}">Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ Request::is('admin/warta/jemaat') ? ' active' : '' }}" href="{{ url('/admin/warta/jemaat') }}">Jemaat</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item{{ Request::is('admin/calendar') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/calendar') }}">
                <i class="menu-icon mdi mdi-calendar"></i>
                <span class="menu-title">Calendar</span>
            </a>
        </li>
    </ul>
</nav>
