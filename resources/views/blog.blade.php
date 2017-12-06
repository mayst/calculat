@extends('layouts.header')

@section('content')
    @if(Auth::guest())
        <section class="search">
            <div class="container">
                <div class="search-header">
                    <h2>blog</h2>
                    <form action="/" class="search-form">
                        <input type="text" class="form-controll" placeholder="Search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </section>
    @endif
    <div class="{{ (Auth::guest()) ? 'container' : 'reg-search-page' }}">
        <div class="{{ (Auth::guest()) ? 'row' : 'container' }}">
            @if(!Auth::guest())
                @include('side_menu')
                <div class="reg-search">
                    <!-- Start Post Item -->
                    <h2 class="title_page">Useful articles</h2>
                    <div class="clear"></div>
            @else

            @endif

            @foreach($articles as $article)
                @if(Auth::guest())
                    <div class="col-sm-6 col-md-6">
                        <div class="post">
                            <div class="post-margin">
                                <h4 class="post-title"><a href="{{ "article/" . $article['title'] }}">{{ $article['title'] }}</a></h4>
                                <div class="clear"></div>
                                <ul class="post-status">
                                    <li><i class="fa fa-clock-o"></i>{{ $article->created_at->format('F d, Y') }}</li>

                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="featured-image">
                                <img src="/{{ $article->thumbnail }}" class="attachment-post-standard "  />
                            </div>

                            <div class="post-margin">
                                <p>{!! html_entity_decode($article['content']) !!}</p>
                            </div>

                            <ul class="post-social">
                                <li><a href="#" target="_blank">
                                        <i class="fa fa-facebook"></i></a>
                                </li>

                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-twitter"></i></a>
                                </li>

                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-google-plus"></i></a>
                                </li>

                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-linkedin"></i></a>
                                </li>

                                <li>
                                    <a href="#" class="readmore">Read More <i class="fa fa-arrow-circle-o-right"></i></a>
                                </li>
                            </ul>

                            <div class="clear"></div>
                        </div>
                    </div>
                @else
                    <div class="post">
                        <div class="post-margin">
                            <h4 class="post-title"><a href="{{ "article/" . $article['title'] }}">{{ $article['title'] }}</a></h4>
                            <div class="clear"></div>
                            <ul class="post-status">
                                <li><i class="fa fa-clock-o"></i>{{ $article->created_at->format('F d, Y') }}</li>

                            </ul>
                            <div class="clear"></div>
                        </div>

                        <div class="featured-image">
                            <img src="{{ $article->thumbnail }}" class="attachment-post-standard "  />
                        </div>

                        <div class="post-margin">
                            {!! html_entity_decode(substr($article['content'], 0, 300)) !!}
                        </div>

                        <ul class="post-social">
                            <li><a href="#" target="_blank">
                                    <i class="fa fa-facebook"></i></a>
                            </li>

                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-twitter"></i></a>
                            </li>

                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-google-plus"></i></a>
                            </li>

                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-linkedin"></i></a>
                            </li>

                            <li>
                                <a href="#" class="readmore">Read More <i class="fa fa-arrow-circle-o-right"></i></a>
                            </li>
                        </ul>

                        <div class="clear"></div>
                    </div>
                @endif
            @endforeach
            <div class="clear"></div>
            {{ $articles->links() }}
        </div>
        @if(!Auth::guest())) </div> @endif
    </div>
    @if(Auth::guest())
        <section class="register-now">
            <div class="container">
                <h2>Register Now</h2>
                <input type="text" class="form-controll" placeholder="Your name">
                <input type="email" class="form-controll" placeholder="Email">
                <div class="checkbox-block">
                    <input id="register-checkbox" type="checkbox" class="checkbox">
                    <label for="register-checkbox">I accept the terms and conditions User Agreement</label>
                </div>
                <button class="purple-btn">Register</button>
            </div>
        </section>
    @endif
@endsection