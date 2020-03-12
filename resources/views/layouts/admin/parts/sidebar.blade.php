<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        @if(empty(auth()->user()->avatar))
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd5_kbfqZdTTsP506OSSvpu9A5nU6JgzV-qfrBq_N_513GdBrZ" alt="profile image">
                        @else
                        <img src="{{ storage()->url(auth()->user()->avatar) }}" alt="profile image">
                        @endif
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name font-weight-bold">{{ auth()->user()->name }}</p>
                        <div>
                            <small class="designation text-muted">Administrator</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->role == 'admin')
                <a class="btn btn-success btn-block" href="{{ url('/admin/article/create') }}">
                    <i class="mdi mdi-plus"></i>
                    Create Article
                </a>
                @endif
            </div>
        </li>
        @if(auth()->user()->role == 'admin')
        <li class="nav-item{{ request()->is('admin') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @endif
        <li class="nav-item{{ request()->is('admin/article') || request()->is('admin/article/*') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/article') }}">
                <i class="menu-icon mdi mdi-clipboard-text"></i>
                <span class="menu-title">Articles</span>
            </a>
        </li>
        @if(auth()->user()->role == 'admin')
        <li class="nav-item{{ request()->is('admin/jemaat') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/jemaat') }}">
                <i class="menu-icon mdi mdi-account-outline"></i>
                <span class="menu-title">Jemaat</span>
            </a>
        </li>
        <li class="nav-item{{ request()->is('admin/gallery/*') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#sd-dropdown-gallery" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-collage"></i>
                <span class="menu-title">Gallery</span>
                <i class="menu-arrow mdi mdi-chevron-down"></i>
            </a>
            <div class="collapse" id="sd-dropdown-gallery">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('admin/gallery/photo') ? ' active' : '' }}" href="{{ url('/admin/gallery/photo') }}">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('admin/gallery/video') ? ' active' : '' }}" href="{{ url('/admin/gallery/video') }}">Video</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item{{ request()->is('admin/warta/*') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#sd-dropdown-warta" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-telegram"></i>
                <span class="menu-title">Warta</span>
                <i class="menu-arrow mdi mdi-chevron-down"></i>
            </a>
            <div class="collapse" id="sd-dropdown-warta">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('admin/warta/umum') ? ' active' : '' }}" href="{{ url('/admin/warta/umum') }}">Umum</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item{{ request()->is('admin/calendar') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/calendar') }}">
                <i class="menu-icon mdi mdi-calendar"></i>
                <span class="menu-title">Calendar</span>
            </a>
        </li>
        <li class="nav-item{{ request()->is('admin/kontributor') ? ' active' : '' }}">
            <a class="nav-link" href="{{ url('/admin/kontributor') }}">
                <i class="menu-icon mdi mdi-account-group"></i>
                <span class="menu-title">Kontributor</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
