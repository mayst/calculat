@extends('layouts.header')

@section('content')
	@php $status = Auth::guest(); @endphp
    <section class="{{ ($status) ? 'profile' : 'reg-profile-page' }}">
        <div class="container">
            @if(!$status)
                @include('side_menu')
                <div class="reg-profile">
            @endif
                    <div class="row">
                        <div class="{{ (!$status) ? 'col-md-5' : 'col-sm-6 col-md-4' }}">
                            <div class="profile-img">
                                <img src="/images/avatars/{{ $info->user->avatar() }}" alt="">
                                @if($info->user->status->online)
                                    <span class="online"></span>
                                @endif
                                @if(!$status)
                                    @if($my_profile = $info->user_id == Auth::user()->id)
                                        <a href="#photo-popup" class="add-photo popup-content">Change Photo</a>
                                    @else
                                        <span class="star"><i class="fa fa-star" aria-hidden="true"></i></span>
                                    @endif
                                @endif
                            </div>
                            @if(!$status)
                                @if(!$my_profile)
                                    <div class="get-chat">
                                        <a href="#" class="purple-btn">Get chat</a>
                                        <a href="#" class="share"></a>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="{{ (!$status) ? 'col-md-7' : 'col-sm-12 col-md-8' }}">
                            <div class="profile-about">
                                <div class="profile-name">
                                    <p class="address">{{ $info->country }}, {{ $info->city }}</p>
                                    <p class="name">
                                        {{ $info->user->name }}
                                        @if(!$status)
                                            @if($my_profile)
                                                <a href="#info-popup" class="popup-content"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="profile-info">
                                    <div class="tabs profile-tabs">
                                        <a href="#profile-tab1" class="profile-tabs-btn">Physique</a>
                                        <a href="#profile-tab2" class="profile-tabs-btn">About</a>
                                        <a href="#profile-tab3" class="profile-tabs-btn">Other</a>
                                    </div>
                                    <a href="#" class="mobile-tabs mobile-tab1 open">Physique <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <div id="profile-tab1" class="profile-info-single">
                                        <div class="row">
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>Age:</p>
                                                    <span>{{ $info->age }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Height:</p>
                                                    <span>{{ $info->height }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Weight:</p>
                                                    <span>{{ $info->weight }}</span>
                                                </div>
                                            </div>
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>Body type:</p>
                                                    <span>{{ $info->body_type }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Zodiak:</p>
                                                    <span>{{ $info->zodiac }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Hair color:</p>
                                                    <span>{{ $info->hair_color }}</span>
                                                </div>
                                            </div>
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>Eyes color:</p>
                                                    <span>{{ $info->eyes_color }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Skin color:</p>
                                                    <span>{{ $info->skin_color }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="mobile-tabs mobile-tab2">About <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <div id="profile-tab2" class="profile-info-single">
                                        <div class="row">
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>Marital status:</p>
                                                    <span>{{ $info->marital_status }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Chilrdens:</p>
                                                    <span>{{ $info->children }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Attitude to alcohol:</p>
                                                    <span>{{ $info->attitude_to_alcohol }}</span>
                                                </div>
                                            </div>
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>Attitude to smoking:</p>
                                                    <span>{{ $info->attitude_to_smoking }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Religious views:</p>
                                                    <span>{{ $info->religious_views }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Education:</p>
                                                    <span>{{ $info->education }}</span>
                                                </div>
                                            </div>
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>Job:</p>
                                                    <span>{{ $info->job }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>Position:</p>
                                                    <span>{{ $info->position }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="mobile-tabs mobile-tab3">Other<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <div id="profile-tab3" class="profile-info-single">
                                        <div class="row">
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <div class="status">
                                                    <p>I live:</p>
                                                    <span>{{ $info->i_live }}</span>
                                                </div>
                                                <div class="status">
                                                    <p>My priorities:</p>
                                                    <span>{{ $info->my_priorities }}</span>
                                                </div>
                                            </div>
                                            <div class="{{ (!$status) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                                <p>Hobby:</p>
                                                <ul class="hobby-list">
                                                    @php preg_match_all('/\w+/', $info->hobby, $hobbies); @endphp
                                                    @foreach($hobbies[0] as $hobby)
                                                        <li>{{ $hobby }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-12 col-lg-4">
                                                <p>Love too:</p>
                                                <ul class="hobby-list">
                                                    @php preg_match_all('/\w+/', $info->love_too, $loves); @endphp
                                                    @foreach($loves[0] as $love)
                                                        <li>{{ $love }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!$status)
                        <section class="prof-about">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="about-single">
                                        <div class="prof-about-title">
                                            <h2>About me</h2>
                                        </div>
                                        <div class="prof-about-text">{{ $info->about_me }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="about-single">
                                        <div class="prof-about-title">
                                            <h2>My desire</h2>
                                        </div>
                                        <div class="prof-about-text">{{ $info->my_desire }}</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    @if(!$status)
                        <p class="gallery">
                            <h2>Gallery</h2>
                            @php $gallery = $info->user->gallery(); @endphp
                            @if($gallery->count())
                                <div class="gallery-photo">
                                    <div class="slider-navs">
                                        <div class="slider-prev slider-prev3">
                                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        </div>
                                        <div class="slider-next slider-next3">
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="gallery-slider2 owl-carousel">
                                        @foreach($gallery as $photo)
                                            <div class="item">
                                                <img src="/images/upload_gallery/{{ $photo->name }}" alt="">
                                                <div class="light-bg"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p>User hasn`t photo.</p>
                            @endif
                        </div>
                    @endif
                </div>
        </div>
    </section>
    @if($status)
        <section class="prof-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-single">
                            <div class="prof-about-title">
                                <h2>About me</h2>
                            </div>
                            <div class="prof-about-text">{{ $info->about_me }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-single">
                            <div class="prof-about-title">
                                <h2>My desire</h2>
                            </div>
                            <div class="prof-about-text">{{ $info->my_desire }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($status)
        <section class="gallery">
            <div class="container">
                <div class="gallery-text">
                    <h2>Gallery</h2>
                </div>
                @php $gallery = $info->user->gallery(); @endphp
                @if($gallery->count())
                    <div class="gallery-photo">
                        <div class="slider-navs">
                            <div class="slider-prev slider-prev3">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </div>
                            <div class="slider-next slider-next3">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="gallery-slider2 owl-carousel">
                            @foreach($gallery as $photo)
                                <div class="item">
                                    <img src="/images/upload_gallery/{{ $photo->name }}" alt="">
                                    <div class="light-bg"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p>User hasn`t photo.</p>
                @endif
            </div>
        </section>
    @endif

    @if(!$status)
        @if($my_profile)

            @include ("modals.user_profile.user_personal_information")
            @include ("modals.user_profile.user_avatar")
        @endif
    @endif

    @if(!$status)
        @include ("modals.chat")
    @endif

@endsection
