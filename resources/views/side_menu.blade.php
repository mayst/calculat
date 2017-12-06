<aside class="main-sidebar">
    <a href="/profile/{{ $profile = Auth::user()->info->id }}" class="logo">
        <img src="/images/logo.png" alt="">
        <span>Dove Dating</span>
    </a>
    <ul class="sidebar-menu">
        <li><a href="/profile/{{ $profile }}"><i class="fa fa-user-o" aria-hidden="true"></i>Profile</a></li>
        <li><a href="{{ url('search') }}"><i class="fa fa-search" aria-hidden="true"></i>Search</a></li>
        <li><a class="popup-content" href="#message-popup"><i class="fa fa-envelope-o" aria-hidden="true"></i>Message</a></li>
        <li><a href="/favorites"><i class="fa fa-star" aria-hidden="true"></i>Favorite</a></li>
        <li class="aside-dropdown">
            <a href="#"><i class="fa fa-th" aria-hidden="true"></i>Service</a>
            <ul class="aside-dropdown-list">
                <li><a href="#">Service1</a></li>
                <li><a href="#">Service2</a></li>
            </ul>
        </li>
    </ul>
    <ul class="sidebar-social">
        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
    </ul>
</aside>