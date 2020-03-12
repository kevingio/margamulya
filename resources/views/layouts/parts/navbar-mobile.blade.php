<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
    <div class="logo menu_mm">
        <a href="{{ route('home') }}">
            <img src="{{ asset('app-asset/img/logo-marga-mulya-invert-black.png') }}" class="img-logo" alt="logo" />
        </a>
    </div>
    <div class="search">
        <input type="search" name="q" class="header_search_input menu_mm search-box" autocomplete="off" required="required" placeholder="Type to Search...">
        <img class="header_search_icon menu_mm" src="{{ asset('app-asset/img/search_2.png') }}" alt="search-icon" />
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            <li class="menu_mm"><a href="{{ route('home') }}">Home</a></li>
            <li class="menu_mm"><a href="{{ route('warta') }}">Warta</a></li>
            <li class="menu_mm"><a href="{{ route('article') }}">Articles</a></li>
            <li class="menu_mm"><a href="{{ route('event') }}">Events</a></li>
            <li class="menu_mm"><a href="{{ route('directory') }}">Directory</a></li>
            <li class="menu_mm"><a href="{{ url('about/gpib-margamulya') }}">GPIB Marga Mulya</a></li>
            <li class="menu_mm"><a href="{{ url('about/gpib') }}">GPIB</a></li>
        </ul>
    </nav>
</div>
