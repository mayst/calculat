<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include ("layouts.common.header_style")
    @include ("layouts.common.header_script")

</head>

<body>
@if(Auth::guest())
    <header class="main-header second-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 burger">
                    <button type="button" class="header-burger">
                        <span></span>
                    </button>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-4">
                    <a href="/" class="logo">
                        <img src="/images/logo.png" alt="">
                        <span>{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-8 col-md-5 col-lg-4">
                    <nav class="main-nav"><?php menu(); ?></nav>
                </div>
                <div class="mobile-nav">
                    <nav class="main-nav">
                        <ul class="header-nav">
                            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                            <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i>About</a></li>
                            <li class="dropdown">
                                <a href="#"><i class="fa fa-th" aria-hidden="true"></i>Service</a>
                                <ul class="dropdown-list open">
                                    <li><a href="#">Service 1</a></li>
                                    <li><a href="#">Service 2</a></li>
                                    <li><a href="#">Service 3</a></li>
                                    <li><a href="#">Service 4</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#"><i class="fa fa-language" aria-hidden="true"></i>Language</a>
                                <ul class="dropdown-list">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Deutsch</a></li>
                                    <li><a href="#">Español</a></li>
                                    <li><a href="#">Français</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xs-4 col-sm-12 col-md-4">
                    <div class="header-login">
                        <div class="login-btns">
                            <a href="#register-popup" class="registration popup-content">Registration</a>
                            <a href="#login-popup" class="login popup-content">Log in</a>
                        </div>
                        <ul class="social-list">
                            <li><a href="#"><img src="/images/fb.png" alt=""></a></li>
                            <li><a href="#"><img src="/images/insta.png" alt=""></a></li>
                            <li><a href="#"><img src="/images/gp.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
@else
    <header class="reg-header">
        <div class="container">
            <div class="burger">
                <button type="button" class="header-burger">
                    <span></span>
                </button>
            </div>
            <div class="mobile-nav">
                <nav class="main-nav">
                    <ul class="header-nav">
                        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                        <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i>About</a></li>
                        <li class="dropdown">
                            <a href="#"><i class="fa fa-th" aria-hidden="true"></i>Service</a>
                            <ul class="dropdown-list open">
                                <li><a href="#">Service 1</a></li>
                                <li><a href="#">Service 2</a></li>
                                <li><a href="#">Service 3</a></li>
                                <li><a href="#">Service 4</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#"><i class="fa fa-language" aria-hidden="true"></i>Language</a>
                            <ul class="dropdown-list">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Deutsch</a></li>
                                <li><a href="#">Español</a></li>
                                <li><a href="#">Français</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="notification-link">
                <div class="notification-click">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    <span class="i-ico">i</span>
                </div>
                <div class="notification">
                    <div class="notification-header">
                        <a href="#"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a>
                        <h2>Notification</h2>
                        <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                    </div>
                    <ul class="notification-list">
                        <li>
                            <a href="#">
                                <img src="/images/user-photo.jpg" alt="">
                                <p>Sam MacCury, 35, added to favorites</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/images/user-photo.jpg" alt="">
                                <p>Sam MacCury, 35, added to favorites</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/images/user-photo.jpg" alt="">
                                <p>Sam MacCury, 35, added to favorites</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/images/user-photo.jpg" alt="">
                                <p>Sam MacCury, 35, added to favorites</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/images/user-photo.jpg" alt="">
                                <p>Sam MacCury, 35, added to favorites</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="acc-setting-link">
                @php $user = Auth::user(); @endphp
                <img src="/images/avatars/{{ $user->avatar() }}" alt="">
                <div class="acc-setting">
                    <div class="acc-setting-header">
                        <img src="/images/avatars/{{ $user->avatar() }}" alt="">
                        <div class="info">
                            <p class="address">Ukraine, Odessa</p>
                            <p class="name">Sam MacCury, 35</p>
                            <a href="#">Edit profile</a>
                            <a href="#">Confidentiality</a>
                        </div>
                    </div>
                    <ul class="acc-setting-list">
                        <li><a href="/settings">Setting</a></li>
                        <li><a href="#">Reference</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">Balance</a></li>
                    </ul>
                    <div class="acc-setting-bottom">
                        <button type="button" id="account-logout" class="logout">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif

@yield('content')

@include('layouts.footer')

@include('layouts.popups')

@include ("layouts.common.footer_script")

</body>
</html>