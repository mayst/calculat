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
</head>
<body>
<section class="welcome">
    <header class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 burger">
                    <button type="button" class="header-burger">
                        <span></span>
                    </button>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-4">
                    <a href="/" class="logo">
                        <img src="images/logo.png" alt="">
                        <span>{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-8 col-md-5 col-lg-4">
                    <nav class="main-nav">
                        {{--<ul class="header-nav">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li class="dropdown">
                                <a href="#">Service</a>
                                <ul class="dropdown-list">
                                    <li><a href="#">Service 1</a></li>
                                    <li><a href="#">Service 2</a></li>
                                    <li><a href="#">Service 3</a></li>
                                    <li><a href="#">Service 4</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">Language</a>
                                <ul class="dropdown-list">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Deutsch</a></li>
                                    <li><a href="#">Español</a></li>
                                    <li><a href="#">Français</a></li>
                                </ul>
                            </li>
                        </ul>--}}
                        <?php menu(); ?>
                    </nav>
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
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <div class="login-btns">
                                <a href="#register-popup" class="registration">Registration</a>
                                <a href="#login-popup" class="login popup-content">Log in</a>
                            </div>
                        @else
                            <div class="login-btns">
                                <a href="/profile/{{ Auth::user()->info->id }}" class="registration" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <a class="login popup-content" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif
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
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="register">
                    <h2>Register Now</h2>
                    <form action="{{ route('register') }}" method="POST" class="register-form">
                        {{ csrf_field() }}
                        <input type="text" class="form-controll" name="name" required placeholder="Your name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                        <input type="email" class="form-controll" name="email" required placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                        <input id="password" type="password" class="form-controll" name="password" required placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <input id="password-confirm" type="password" class="form-controll" name="password_confirmation" required placeholder="Confirm Password">
                        <div class="checkbox-block">
                            <input id="register-checkbox" type="checkbox" class="checkbox">
                            <label for="register-checkbox">I accept the terms and conditions User Agreement</label>
                        </div>
                        <div class="register-btn">
                            <button class="purple-btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="welcome-text">
                    <h2>Find <br> the <span>girl</span> <br> of <span>your dreams</span></h2>
                    <p>with Dove Dating</p>
                    <span class="trial">Use services 7 days FREE of charge</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="search-sect">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="quick-search">
                    <img src="/images/qs.jpg" alt="">
                    <form action="/" class="quick-search-form">
                        <h2>quick search</h2>
                        <input type="text" placeholder="Name" class="form-controll">
                        <select name="Status" class="select">
                            <option value="Status 1">Status 1</option>
                            <option value="Status 2">Status 2</option>
                            <option value="Status 3">Status 3</option>
                        </select>
                        <select name="Age" class="select">
                            <option value="Age 1">Age 1</option>
                            <option value="Age 2">Age 2</option>
                            <option value="Age 3">Age 3</option>
                        </select>
                        <button class="purple-btn">Search</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="finding-people owl-carousel">
                    <div class="item">
                        <div class="single">
                            <img src="/images/s1.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single">
                            <img src="/images/s2.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="single">
                            <img src="/images/s3.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single">
                            <img src="/images/s4.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="single">
                            <img src="/images/s1.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single">
                            <img src="/images/s2.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="single">
                            <img src="/images/s3.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single">
                            <img src="/images/s4.jpg" alt="">
                            <span class="online"></span>
                            <div class="people-info">
                                <div class="people-about">
                                    <p class="name">Alice, <span class="age">23</span></p>
                                    <p class="address">Ukraine, Odessa</p>
                                </div>
                                <a href="#" class="get-chat">Get Chat</a>
                            </div>
                            <div class="people-options">
                                <ul class="options-list">
                                    <li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="about-us">
                    <h2>About us</h2>
                    <div class="about-us-dove">
                        <h3>Dove Dating</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur.</p>
                    </div>
                </div>
                <img src="/images/a1.jpg" alt="">
            </div>
            <div class="col-md-4">
                <div class="about-info">
                    <h2>About us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dreams">
    <div class="container">
        <h2>Look for your dreams</h2>
        <div class="row">
            <div class="col-md-7">
                <form action="/" class="dreams-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-controll">
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <select name="Age" class="select">
                            <option value="23-25">23-25</option>
                            <option value="23-25">23-25</option>
                            <option value="23-25">23-25</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Weight</label>
                        <select name="Weight" class="select">
                            <option value="55 - 60 kg">55 - 60 kg</option>
                            <option value="55 - 60 kg">55 - 60 kg</option>
                            <option value="55 - 60 kg">55 - 60 kg</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="Status" class="select">
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <select name="City" class="select">
                            <option value="Odessa">Odessa</option>
                            <option value="Odessa">Odessa</option>
                            <option value="Odessa">Odessa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Height</label>
                        <select name="Height" class="select">
                            <option value="1.65 - 1.75 m">1.65 - 1.75 m</option>
                            <option value="1.65 - 1.75 m">1.65 - 1.75 m</option>
                            <option value="1.65 - 1.75 m">1.65 - 1.75 m</option>
                        </select>
                    </div>
                    <a href="#" class="advanced-search">Advanced search<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    <button class="purple-btn">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>
    <section class="happy-dating">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="happy-dating-man">
                        <h2>Happy Dating<br> of our men</h2>
                        <div class="man-info">
                            <p class="name">Sam, 23</p>
                            <p class="address">Ukraine, Odessa</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="quotation slider-for">
                        <div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>2Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>3Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>4Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>5Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="happy-dating-men">
                <div class="slider-navs">
                    <div class="slider-prev slider-prev1">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </div>
                    <div class="slider-next slider-next1">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="men-slider slider-nav">
                    <div>
                        <div class="item">
                            <div data-name="1Sam, 23" data-address="1Ukraine, Odessa" class="man">
                                <img src="/images/men1.jpg" alt="">
                                <div class="light-bg"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="item">
                            <div data-name="2Sam, 23" data-address="2Ukraine, Odessa" class="man">
                                <img src="/images/men1.jpg" alt="">
                                <div class="light-bg"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="item">
                            <div data-name="3Sam, 23" data-address="3Ukraine, Odessa" class="man">
                                <img src="/images/men1.jpg" alt="">
                                <div class="light-bg"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="item">
                            <div data-name="4Sam, 23" data-address="4Ukraine, Odessa" class="man">
                                <img src="/images/men1.jpg" alt="">
                                <div class="light-bg"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="item">
                            <div data-name="5Sam, 23" data-address="5Ukraine, Odessa" class="man">
                                <img src="/images/men1.jpg" alt="">
                                <div class="light-bg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="have-question">
                        <div class="main">
                            <p class="question-title">if you Have:</p>
                            <p class="question">Any questions about the service?</p>
                            <p class="question">Need advice?</p>
                            <p class="question">Have questions?</p>
                            <p class="write">Write to us!</p>
                        </div>
                        <div class="question-bg">
                            <p class="question-title">if you Have:</p>
                            <p class="question">Any questions about the service?</p>
                            <p class="question">Need advice?</p>
                            <p class="question">Have questions?</p>
                            <p class="write">Write to us!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h2>Contact Us</h2>
                    <form action="/" class="contact-form">
                        <div class="form-block">
                            <input type="text" class="form-controll" placeholder="Your name">
                            <input type="text" class="form-controll" placeholder="Viber / Whatsapp">
                            <input type="email" class="form-controll" placeholder="Email">
                        </div>
                        <div class="form-block">
                            <textarea class="form-controll" placeholder="Message"></textarea>
                            <button class="purple-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="contact-us">
                    <p>Contact Us</p>
                </div>
            </div>
        </div>
    </section>

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