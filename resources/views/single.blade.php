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
                <div class="post" style="margin: 20px 0px">
                    <div class="post-margin" style="margin: 20px 0px">
                        <h1>{{ $page->title }}</h1><div class="clear"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="post-margin">
                        {!! html_entity_decode($page->content) !!}
                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                </div>
                <!-- End Post Item -->
            </div>
        </div>
    </section>


@endsection