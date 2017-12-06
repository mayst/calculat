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
@php $status = Auth::guest(); @endphp
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
                        @if ($status)
                            <div class="login-btns">
                                <a href="#register-popup" class="registration popup-content">Registration</a>
                                <a href="#login-popup" class="login popup-content">Log in</a>
                            </div>
                        @else
                            @php $user = Auth::user(); @endphp
                            <div class="login-btns">
                                <a href="/profile/{{ $user->info->id }}" class="registration" aria-expanded="false">
                                    {{ $user->name }} <span class="caret"></span>
                                </a>
                                <button type="button" id="account-logout" class="login popup-content">Logout</button>
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
    @if($status)
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="register">
                        <h2>Register Now</h2>
                        <form action="{{ route('register') }}" method="post" class="register-form">
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
                                <input id="register-checkbox" type="checkbox" class="checkbox" required>
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
    @endif
</section>

<section class="search-sect">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="quick-search">
                    <img src="/images/qs.jpg" alt="">
                    <div class="quick-search-form">

                        <form id="quick-search-form" action="javascript:void(null)" method="post">

                            <h2>Quick Search</h2>

                            <input type="text" name="girl_name" placeholder="Name" class="form-controll">

                            <select name="marital_status" class="select">
                                <option>Not married</option>
                                <option>Married</option>
                                <option>Actively searching</option>
                                <option>Divorced</option>
                            </select>

                            <select name="children_exist" class="select">
                                <option>Have</option>
                                <option>Haven`t</option>
                            </select>

                            <input type="submit" class="purple-btn" value="Search">

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="quick-search-result" class="finding-people owl-carousel">
                    @foreach($womans as $i => $woman)

                        @if($i === 0 || $i % 2 === 0) <div class="item"> @endif

                            <div class="single">
                                <img src="/images/avatars/{{ $woman->user->avatar() }}" alt="{{ $woman->user->name }} Avatar">
                                @if($woman->user->status->online) <span class="online"></span> @endif
                                <div class="people-info">
                                    <div class="people-about">
                                        <p class="name">{{ $woman->user->name }}, <span class="age">00</span></p>
                                        <p class="address">{{ $woman->city }}, {{ $woman->country }}</p>
                                    </div>
                                    <a href="#" class="get-chat">Get Chat</a>
                                </div>
                                <div class="people-options">
                                    <ul class="options-list">
                                        <li><a href="/profile/{{ $woman->id }}" class="show-user-profile">Show profile</a></li>
                                    </ul>
                                </div>
                            </div>

                        @if($i % 2 !== 0) </div> @endif

                    @endforeach
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
                    <p>Hello, dear guests!
                        We are Dove Dating Odessa & Entertainments  -and we are your personal assistant for a good rest and dating.
                        We are not  a marriage agency and escort! We are dating service(social network) and creators of your trip to Odessa.
                        Our clients are all real women from Odessa who were interviewed and their identities were verified before the
                        registration procedure and have serious intentions<br>
                        There are 2 galleries of women: 1-st from Odessa and 2-nd from all over Ukraine.
                    </p>
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
                <form action="/search" class="dreams-form">
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
                    <a href="/search" class="advanced-search">Advanced search<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
                                    <p>Hello to everyone! I am Zachary , 52 y.o, homeopath and professional traveler.I visited 53 countries.
                                        One fine day I was sitting home and watching news . And i saw an episode about Ukraine. I have never been
                                        there,so I decided to visit this country.Some months later,near summer time,I started to surf in net , looking for
                                        information and think about how to plan my next journey.Which city to choose?Well,I read about seaport town
                                        Odessa.In internet I fortuned DOVE service link. I examined pics and enough information was accessible.</p>
                                </div>
                                <div class="col-md-6">
                                    <p>After
                                        speaking to managers I thought-“Right choice!”. So, as a result,I spent an unforgettable week in amazing  sunny and
                                        funny Odessa: friendly and kind people, comfortable and contemporary apartment, delicious and inexpensive
                                        seafood ,interesting excursions , and very beautiful women! I really enjoyed my trip, now I can say Odessa is the city
                                        that I will absolutely love traveling to again and again.  P.S. My appreciation of managers’ work and DOVE service is
                                        to be recommended for its high organization level. Cheerie-bye!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Hello from Dallas (USA)
                                        My name is Mike. And I am absolutely happy guy 35 years old. MY story began a year ago in Odessa, I&#39;ve never
                                        been to Odessa before, it was a very long journey. But thanks to the managers of Dove Dating, I have a lot of fun and
                                        nice emotions, and most importantly I met my love.
                                        We had dates, romantic walks, excursions, it was amazing. I will never forget Odessa with this atmosphere of love.
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>My girlfriend was already in Dallas, and soon will come again, and after we fly back to Odessa together, I and my
                                        parents should get acquainted with her family.
                                        The command of Dove Dating introduced me to the charming girl who will be my wife soon (I hope). In the whirlpool
                                        of life, I lost hope, to meet a person close to my soul. I hope with your site and service, more and more people will
                                        come to you to get a dream!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Hi. My name is Walter B. and I wanna leave my small review here. To begin with, some years ago I had gotten out of
                                        my long-term relationships. Near 1,5 year ago I understood that I was ready to go ahead and I went to Miami to relax
                                        my mind and hung out. Clubs,pubs, beach... it was hard meeting single. For me dating was difficult always. I
                                        remembered I was trying online dating at my time in University.
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>I knew I was so weird, I’d be hard to date But my wish to create family was getting
                                        bigger and bigger day by day.   I read somewhere that the best potential wives  are Slavonian, they hadn’t lost their
                                        femininity and focus on hearth and home. I met  DOVE in internet and wrote them about my wish to find lady who
                                        would want to have family. Managers helped me to find match for me and for “Her”.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div>
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
                    </div>--}}
                </div>
            </div>
        </div>
        <div class="happy-dating-men">

            <div class="men-slider slider-nav">
                <div>
                    <div class="item">
                        <div class="man">
                            <img src="/images/1st_history.jpg" alt="">
                            <div class="light-bg"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="item">
                        <div class="man">
                            <img src="/images/2-nd_history.jpg" alt="">
                            <div class="light-bg"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="item">
                        <div class="man">
                            <img src="/images/3-rd_history.jpg" alt="">
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
                <form action="/send_contact" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <div class="form-block">
                        <input type="text" name="name" class="form-controll" placeholder="Your name">
                        <input type="text" name="viber" class="form-controll" placeholder="Viber / Whatsapp">
                        <input type="email" name="email" class="form-controll" placeholder="Email">
                    </div>
                    <div class="form-block">
                        <textarea name="msg" class="form-controll" placeholder="Message"></textarea>
                        <button type="submit" class="purple-btn">Send</button>
                    </div>
                </form>
            </div>
            <div class="contact-us">
                <p>Contact Us</p>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

@include('layouts.popups')

@include ("layouts.common.footer_script")

</body>
</html>
