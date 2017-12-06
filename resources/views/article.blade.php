@extends('layouts.header')

@section('content')
    <section class="{{ (Auth::guest()) ? '' : 'reg-search-page' }}">
        <div class="container">
            @if(!Auth::guest())
                @include('side_menu')
            @endif
            <div class="reg-search">
                <!-- Start Post Item -->
                <div class="clear"></div>
                <div class="post">
                    <div class="post-margin">
                        <h4>{{ $article->title }}</h4><div class="clear"></div>
                        <ul class="post-status">
                            <li><i class="fa fa-clock-o"></i>{{ $article->created_at->format('F d, Y') }}</li>
                        </ul>
                        <div class="clear"></div>
                    </div>

                    <div class="featured-image">
                        <img src="/{{ $article->thumbnail }}" class="attachment-post-standard "  />
                    </div>

                    <div class="post-margin">
                        {!! html_entity_decode($article->content) !!}
                        <div class="clear"></div>
                    </div>

                    <!-- Post Social -->
                    <ul class="post-social">
                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>

                        <li><a href="#" target="_blank">
                                <i class="fa fa-linkedin"></i></a></li>
                    </ul>
                    <!-- End Post Social -->
                    <div class="clear"></div>
                </div>
                <!-- End Post Item -->

                <div class="post">
                    <div class="post-margin">
                        @foreach($last_articles as $last_article)
                            <!-- Start Related Item -->
                                <div class="related-posts">
                                    <div class="post-avatar">
                                        <div class="avatar-frame"></div>
                                        <img width="70" height="70" src="/{{ $last_article->thumbnail }}" class="attachment-post-widget #"  />
                                    </div>
                                    <div class="related-posts-aligned">
                                        <h6><a href="{{ $last_article->title }}">{{ $last_article->title }}</a></h6>
                                        {!! html_entity_decode(substr($last_article->content, 0, 100)) !!} <a href="#">Read More &rarr;</a></p>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <!-- End Related Item -->
                        @endforeach
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

