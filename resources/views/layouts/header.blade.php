<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dove Dating</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/libs/nice-select/nice-select.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/libs/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="/libs/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="/libs/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="/libs/slick/slick.css">
    <link rel="stylesheet" href="/css/nouislider.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/media.css">

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>
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
                <img src="/images/user-photo.jpg" alt="">
                <div class="acc-setting">
                    <div class="acc-setting-header">
                        <img src="/images/user-photo.jpg" alt="">
                        <div class="info">
                            <p class="address">Ukraine, Odessa</p>
                            <p class="name">Sam MacCury, 35</p>
                            <a href="#">Edit profile</a>
                            <a href="#">Confidentiality</a>
                        </div>
                    </div>
                    <ul class="acc-setting-list">
                        <li><a href="#">Setting</a></li>
                        <li><a href="#">Reference</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">Balance</a></li>
                    </ul>
                    <div class="acc-setting-bottom">
                        <a href="{{ route('logout') }}" class="logout"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <a href="#" class="add-acc">Add account</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif

@yield('content')

@extends('layouts.footer')

@extends('layouts.popups')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/libs/nice-select/nice-select.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/libs/owl-carousel/owl.carousel.min.js"></script>
<script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/libs/slick/slick.min.js"></script>
<script src="/js/nouislider.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>