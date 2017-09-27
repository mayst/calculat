@extends('layouts.header')

@section('content')
   <section class="{{ (Auth::guest()) ? 'profile' : 'reg-profile-page' }}">
       <div class="container">
           @if(!Auth::guest())
               @include('side_menu')
               <div class="reg-profile">
           @endif
           <div class="row">
               <div class="{{ (!Auth::guest()) ? 'col-md-5' : 'col-sm-6 col-md-4' }}">
                   <div class="profile-img">
                       <img src="/images/prof1.jpg" alt="">
                       <span class="online"></span>
                       <span class="star"><i class="fa fa-star" aria-hidden="true"></i></span>
                   </div>
                   <div class="get-chat">
                       <a href="#" class="purple-btn">Get chat</a>
                       <a href="#" class="share"></a>
                   </div>
               </div>
               <div class="{{ (!Auth::guest()) ? 'col-md-7' : 'col-sm-12 col-md-8' }}">
                   <div class="profile-about">
                       <div class="profile-name">
                           <p class="address">{{ $info->country }}, {{ $info->city }}</p>
                           <p class="name">{{ $info->user->name }}<a href="#info-popup" class="popup-content"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
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
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                       <div class="status">
                                           <p>I live:</p>
                                           <span>{{ $info->i_live }}</span>
                                       </div>
                                       <div class="status">
                                           <p>My priorities:</p>
                                           <span>{{ $info->my_priorities }}</span>
                                       </div>
                                   </div>
                                   <div class="{{ (!Auth::guest()) ? 'col-md-12' : 'col-md-12 col-lg-4' }}">
                                       <p>Hobby:</p>
                                       <ul class="hobby-list">
                                           <li>Book</li>
                                           <li>Horseback Riding</li>
                                           <li>Knitting</li>
                                           <li>Fishing</li>
                                           <li>Knitting</li>
                                       </ul>
                                   </div>
                                   <div class="col-md-12 col-lg-4">
                                       <p>Love too:</p>
                                       <ul class="hobby-list">
                                           <li>Steven king</li>
                                           <li>Slipknot</li>
                                           <li>Eat pizza</li>
                                           <li>Cook</li>
                                           <li>Tea</li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           @if(!Auth::guest())
               <section class="prof-about">
                   <div class="row">
                       <div class="col-md-12 col-lg-6">
                           <div class="about-single">
                               <div class="prof-about-title">
                                   <h2>About me</h2>
                               </div>
                               <div class="prof-about-text">
                                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                                   <p>Oeprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12 col-lg-6">
                           <div class="about-single">
                               <div class="prof-about-title">
                                   <h2>My desire</h2>
                               </div>
                               <div class="prof-about-text">
                                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                                   <p>Oeprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                               </div>
                           </div>
                       </div>
                   </div>
               </section>
           @endif
           @if(!Auth::guest())
                   <div class="gallery">
                       <div class="gallery-text">
                           <h2>Gallery</h2>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore m ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
                       </div>
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
                               <div class="item">
                                   <img src="/images/g1.jpg" alt="">
                                   <div class="light-bg"></div>
                               </div>
                               <div class="item">
                                   <img src="/images/g2.jpg" alt="">
                                   <div class="light-bg"></div>
                               </div>
                               <div class="item">
                                   <img src="/images/g3.jpg" alt="">
                                   <div class="light-bg"></div>
                               </div>
                               <div class="item">
                                   <img src="/images/g4.jpg" alt="">
                                   <div class="light-bg"></div>
                               </div>
                           </div>
                       </div>
                   </div>
           @endif
       </div>
       </div>
   </section>
   @if(Auth::guest())
       <section class="prof-about">
           <div class="container">
               <div class="row">
                   <div class="col-md-6">
                       <div class="about-single">
                           <div class="prof-about-title">
                               <h2>About me</h2>
                           </div>
                           <div class="prof-about-text">
                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                               <p>Oeprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="about-single">
                           <div class="prof-about-title">
                               <h2>My desire</h2>
                           </div>
                           <div class="prof-about-text">
                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                               <p>Oeprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   @endif
   @if(Auth::guest())
       <section class="gallery">
           <div class="container">
               <div class="gallery-text">
                   <h2>Gallery</h2>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore m ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
               </div>
               <div class="gallery-photo">
                   <div class="slider-navs">
                       <div class="slider-prev slider-prev2">
                           <i class="fa fa-angle-left" aria-hidden="true"></i>
                       </div>
                       <div class="slider-next slider-next2">
                           <i class="fa fa-angle-right" aria-hidden="true"></i>
                       </div>
                   </div>
                   <div class="gallery-slider owl-carousel">
                       <div class="item">
                           <img src="/images/g1.jpg" alt="">
                           <div class="light-bg"></div>
                       </div>
                       <div class="item">
                           <img src="/images/g2.jpg" alt="">
                           <div class="light-bg"></div>
                       </div>
                       <div class="item">
                           <img src="/images/g3.jpg" alt="">
                           <div class="light-bg"></div>
                       </div>
                       <div class="item">
                           <img src="/images/g4.jpg" alt="">
                           <div class="light-bg"></div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   @endif

   <div id="info-popup" class="popup-info mfp-hide zoom-anim-dialog">
       <div class="popup-info-header">
           <h2>Information</h2>
       </div>
       <div class="popup-info-content">
           <div class="row">
               <div class="col-sm-4">
                   <div class="tabs popup-tabs">
                       <a href="#popup-tab1" class="popup-tabs-btn">Basic</a>
                       <a href="#popup-tab2" class="popup-tabs-btn active">Physique</a>
                       <a href="#popup-tab3" class="popup-tabs-btn">About</a>
                       <a href="#popup-tab4" class="popup-tabs-btn">Hobby</a>
                       <a href="#popup-tab5" class="popup-tabs-btn">Other</a>
                   </div>
               </div>
               <div class="col-sm-8">
                   <div class="popup-tabs-content">
                       <form action="/save_profile/{{ $info->id }}" method="POST" class="popup-info-form">
                           {{ csrf_field() }}

                           <div id="popup-tab1" class="popup-tab">
                               <div class="form-group">
                                   <label for="popup-info-name">Name:</label>
                                   <input id="popup-info-name" type="text" name="name" class="form-controll" min="2" max="50" value="{{ $info->user->name }}" placeholder="Name">
                               </div>
                               <div class="form-group">
                                   <label for="age">Age:</label>
                                   <input type="date" id="age" name="age">
                               </div>
                               <div class="form-group">
                                   <label>Country:</label>
                                   <select name="country" class="select">
                                       <option value="{{ $info->country }}" selected>{{ $info->country }}</option>
                                       <option value="Country 1">Ukraine</option>
                                       <option value="Country 2">Country 2</option>
                                       <option value="Country 3">Country 3</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>City:</label>
                                   <select name="city" class="select">
                                       <option value="{{ $info->city }}" selected>{{ $info->city }}</option>
                                       <option value="City 1">City 1</option>
                                       <option value="City 2">City 2</option>
                                       <option value="City 3">City 3</option>
                                   </select>
                               </div>
                               <button type="submit">submit</button>
                           </div>
                           <div id="popup-tab2" class="popup-tab">
                               <div class="form-group">
                                   <label for="height">Height:</label>
                                   <input id="height" name="height" type="text" min="3" max="3" value="{{ $info->height }}">
                               </div>
                               <div class="form-group">
                                   <label for="weight">Weight:</label>
                                   <input id="weight" name="weight" type="text" min="2" max="3" value="{{ $info->weight }}">
                               </div>
                               <div class="form-group">
                                   <label>Body type:</label>
                                   <select name="body_type" class="select">
                                       <option value="{{ $info->body_type }}" selected>{{ $info->body_type }}</option>
                                       <option value="Thin">Thin</option>
                                       <option value="Slim">Slim</option>
                                       <option value="Thick">Thick</option>
                                       <option value="Full">Full</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Zodiac:</label>
                                   <select name="zodiac" class="select">
                                       <option value="{{ $info->zodiac }}" selected>{{ $info->zodiac }}</option>
                                       <option value="Aquarius">Aquarius</option>
                                       <option value="Pisces">Pisces</option>
                                       <option value="Aries">Aries</option>
                                       <option value="Taurus">Taurus</option>
                                       <option value="Gemini">Gemini</option>
                                       <option value="Cancer">Cancer</option>
                                       <option value="Leo">Leo</option>
                                       <option value="Virgo">Virgo</option>
                                       <option value="Libra">Libra</option>
                                       <option value="Scorpio">Scorpio</option>
                                       <option value="Sagittarius">Sagittarius</option>
                                       <option value="Capricorn">Capricorn</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Hair color:</label>
                                   <select name="hair_color" class="select">
                                       <option value="{{ $info->hair_color }}" selected>{{ $info->hair_color }}</option>
                                       <option value="Blonde">Blonde</option>
                                       <option value="Brown-haired">Brown-haired</option>
                                       <option value="Red-haired">Red-haired</option>
                                       <option value="Brunette">Brunette</option>
                                       <option value="Dyed">Dyed</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Eyes color:</label>
                                   <select name="eyes_color" class="select">
                                       <option value="{{ $info->eyes_color }}" selected>{{ $info->eyes_color }}</option>
                                       <option value="Brown">Brown</option>
                                       <option value="Green">Green</option>
                                       <option value="Gray">Gray</option>
                                       <option value="Blue">Blue</option>
                                       <option value="Black">Black</option>
                                       <option value="Yellow">Yellow</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Skin color:</label>
                                   <select name="skin_color" class="select">
                                       <option value="{{ $info->skin_color }}" selected>{{ $info->skin_color }}</option>
                                       <option value="Skin color 1">Skin color 1</option>
                                       <option value="Skin color 2">Skin color 2</option>
                                       <option value="Skin color 3">Skin color 3</option>
                                   </select>
                               </div>
                               <button type="submit">submit</button>
                           </div>
                           <div id="popup-tab3" class="popup-tab">
                               <div class="form-group">
                                   <label>Marital status:</label>
                                   <select name="marital_status" class="select">
                                       <option value="{{ $info->marital_status }}" selected>{{ $info->marital_status }}</option>
                                       <option value="Not married">Not married</option>
                                       <option value="Married">Married</option>
                                       <option value="Actively searching">Actively searching</option>
                                       <option value="Divorced">Divorced</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Chilrdens:</label>
                                   <select name="chilrdens" class="select">
                                       <option value="{{ $info->chilrden }}" selected>{{ $info->chilrden }}</option>
                                       <option value="Weight 1">Have</option>
                                       <option value="Weight 2">Haven`t</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Attitude to alcohol:</label>
                                   <select name="attitude_to_alcohol" class="select">
                                       <option value="{{ $info->attitude_to_alcohol }}" selected>{{ $info->attitude_to_alcohol }}</option>
                                       <option value="Negative">Negative</option>
                                       <option value="Compromise">Compromise</option>
                                       <option value="Neutral">Neutral</option>
                                       <option value="Positive">Positive</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Attitude to smoking:</label>
                                   <select name="attitude_to_smoking" class="select">
                                       <option value="{{ $info->attitude_to_smoking }}" selected>{{ $info->attitude_to_smoking }}</option>
                                       <option value="Negative">Negative</option>
                                       <option value="Compromise">Compromise</option>
                                       <option value="Neutral">Neutral</option>
                                       <option value="Positive">Positive</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Religious views:</label>
                                   <select name="religious_views" class="select">
                                       <option value="{{ $info->religious_views }}" selected>{{ $info->religious_views }}</option>
                                       <option value="Judaism">Judaism</option>
                                       <option value="Orthodoxy">Orthodoxy</option>
                                       <option value="Catholicism">Catholicism</option>
                                       <option value="Protestantism">Protestantism</option>
                                       <option value="Islam">Islam</option>
                                       <option value="Buddhism">Buddhism</option>
                                       <option value="Confucianism">Confucianism</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   {{--NEED TO MAKE AJAX--}}
                                   <label>Education:</label>
                                   <div class="wrapper-city">
                                       <input type="text" id="education" name="education" autocomplete="off">
                                       <span class="clear">x</span>
                                       <ul id="ed_result" class="cityresult">

                                       </ul>
                                   </div>
                                   <script>
                                       var input1 = document.getElementById('education');
                                        input1.oninput = function() {
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ url('ajax/find') }}",
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                dataType: "json",
                                                data: { category: "education", word: input1.value },
                                                beforeSend: function() {
                                                    $('#ed_result').html('');
                                                },
                                                success: function (data) {
                                                    for(var a in data.response) {
                                                        $('#ed_result').append("<li class='choice'>" + data.response[a].education + "</li>");
                                                    }
                                                }
                                            });
                                        };
                                   </script>
                               </div>
                               <div class="form-group">
                                   {{--NEED TO MAKE AJAX--}}
                                   <label>Job:</label>
                                   <div class="wrapper-city">
                                       <input type="text" id="job" name="education" autocomplete="off">
                                       <span class="clear">x</span>
                                       <ul id="job_result" class="cityresult">

                                       </ul>
                                   </div>
                                   <script>
                                       var input2 = document.getElementById('job');
                                       input2.oninput = function() {
                                           $.ajax({
                                               type: "POST",
                                               url: "{{ url('ajax/find') }}",
                                               headers: {
                                                   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                               },
                                               dataType: "json",
                                               data: { category: "job", word: input2.value },
                                               beforeSend: function() {
                                                   $('#job_result').html('');
                                               },
                                               success: function (data) {
                                                   for(var a in data.response) {
                                                       $('#job_result').append("<li class='choice'>" + data.response[a].job + "</li>");
                                                       console.log(data.response[a].job);
                                                   }
                                               }
                                           });

                                           function change() {
                                               console.log('+');
//                                                $('#education').val($(this).val())
                                           }
                                       };
                                       document.getElementsByClassName('choice').onclick = function() {
                                           console.log('fgh');
                                       }
                                   </script>
                               </div>
                               <div class="form-group">
                                   {{--NEED TO MAKE AJAX--}}
                                   <label>Position:</label>
                                   <div class="wrapper-city">
                                       <input type="text" id="position" name="position" autocomplete="off">
                                       <span class="clear">x</span>
                                       <ul id="pos_result" class="cityresult">

                                       </ul>
                                   </div>
                                   <script>
                                       var input3 = document.getElementById('position');
                                       input3.oninput = function() {
                                           $.ajax({
                                               type: "POST",
                                               url: "{{ url('ajax/find') }}",
                                               headers: {
                                                   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                               },
                                               dataType: "json",
                                               data: { category: "position", word: input3.value },
                                               beforeSend: function() {
                                                   $('#pos_result').html('');
                                               },
                                               success: function (data) {
                                                   for(var a in data.response) {
                                                       $('#pos_result').append("<li class='choice'>" + data.response[a].position + "</li>");
                                                       console.log(data.response[a].position);
                                                   }
                                               }
                                           });

                                           function change() {
                                               console.log('+');
//                                                $('#education').val($(this).val())
                                           }
                                       };
                                       document.getElementsByClassName('choice').onclick = function() {
                                           console.log('fgh');
                                       }
                                   </script>
                               </div>
                               <button type="submit">submit</button>
                           </div>
                           <div id="popup-tab4" class="popup-tab">
                               <div class="form-group">
                                   <label>About me:</label>
                                   <textarea class="form-controll">{{ $info->about_me }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label>My desire:</label>
                                   <textarea class="form-controll">{{ $info->my_desire }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label>I live:</label>
                                   <select name="i_live" class="select">
                                       <option value="{{ $info->i_live }}" selected>{{ $info->i_live }}</option>
                                       <option value="Own Apartment">Own apartment</option>
                                       <option value="Private house">Private house</option>
                                       <option value="Rented accommodation">Rented accommodation</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>My priorities:</label>
                                   <select name="my_priorities" class="select">
                                       <option value="{{ $info->my_priorities }}" selected>{{ $info->my_priorities }}</option>
                                       <option value="Communication">Communication</option>
                                       <option value="Family and kids">Family and kids</option>
                                       <option value="Traveling">Traveling</option>
                                       <option value="Friendship">Friendship</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Hobby:</label>
                                   <div class="wrapper-city">
                                       <input type="text" id="hobby" name="position" autocomplete="off">
                                       <span class="clear">x</span>
                                       <ul id="hob_result" class="cityresult">

                                       </ul>
                                   </div>
                                   <script>
                                       var input4 = document.getElementById('hobby');
                                       input4.oninput = function() {
                                           $.ajax({
                                               type: "POST",
                                               url: "{{ url('ajax/find') }}",
                                               headers: {
                                                   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                               },
                                               dataType: "json",
                                               data: { category: "hobby", word: input4.value },
                                               beforeSend: function() {
                                                   $('#hob_result').html('');
                                               },
                                               success: function (data) {
                                                   for(var a in data.response) {
                                                       $('#hob_result').append("<li class='choice'>" + data.response[a].hobby + "</li>");
                                                       console.log(data.response[a].hobby);
                                                   }
                                               }
                                           });

                                           function change() {
                                               console.log('+');
//                                                $('#education').val($(this).val())
                                           }
                                       };
                                       document.getElementsByClassName('choice').onclick = function() {
                                           console.log('fgh');
                                       }
                                   </script>
                               </div>
                               <div class="tags">
                                   <p class="tag">Book<a href="#">X</a></p>
                                   <p class="tag">Book<a href="#">X</a></p>
                                   <p class="tag">Book<a href="#">X</a></p>
                                   <p class="tag">Book<a href="#">X</a></p>
                                   <p class="tag">Book<a href="#">X</a></p>
                                   <p class="tag">Book<a href="#">X</a></p>
                                   <p class="tag">Book<a href="#">X</a></p>
                               </div>
                               <div class="form-group">
                                   <label>Love too:</label>
                                   <div class="wrapper-city">
                                       <input type="text" id="love_too" name="love_too" autocomplete="off">
                                       <span class="clear">x</span>
                                       <ul id="too_result" class="cityresult">

                                       </ul>
                                   </div>
                                   <script>
                                       var input5 = document.getElementById('love_too');
                                       input5.oninput = function() {
                                           $.ajax({
                                               type: "POST",
                                               url: "{{ url('ajax/find') }}",
                                               headers: {
                                                   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                               },
                                               dataType: "json",
                                               data: { category: "love_too", word: input5.value },
                                               beforeSend: function() {
                                                   $('#too_result').html('');
                                               },
                                               success: function (data) {
                                                   for(var a in data.response) {
                                                       $('#too_result').append("<li class='choice'>" + data.response[a].love_too + "</li>");
                                                       console.log(data.response[a].love_too);
                                                   }
                                               }
                                           });

                                           function change() {
                                               console.log('+');
//                                                $('#education').val($(this).val())
                                           }
                                       };
                                       document.getElementsByClassName('choice').onclick = function() {
                                           console.log('fgh');
                                       }
                                   </script>
                               </div>
                               <div class="tags">
                                   <p class="tag">Steven king<a href="#">X</a></p>
                                   <p class="tag">Steven king<a href="#">X</a></p>
                                   <p class="tag">Steven king<a href="#">X</a></p>
                                   <p class="tag">Steven king<a href="#">X</a></p>
                                   <p class="tag">Steven king<a href="#">X</a></p>
                                   <p class="tag">Steven king<a href="#">X</a></p>
                                   <p class="tag">Steven king<a href="#">X</a></p>
                               </div>
                               <button type="submit">submit</button>
                           </div>
                           <div id="popup-tab5" class="popup-tab">
                               <div class="form-group">
                                   <label>Education:</label>
                                   <select name="Education" class="select">
                                       <option value="Education 1">Education 1</option>
                                       <option value="Education 2">Education 2</option>
                                       <option value="Education 3">Education 3</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Job:</label>
                                   <select name="Job" class="select">
                                       <option value="Job 1">Job 1</option>
                                       <option value="Job 2">Job 2</option>
                                       <option value="Job 3">Job 3</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>I live:</label>
                                   <select name="I live" class="select">
                                       <option value="I live 1">I live 1</option>
                                       <option value="I live 2">I live 2</option>
                                       <option value="I live 3">I live 3</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>My priorities:</label>
                                   <select name="My priorities" class="select">
                                       <option value="My priorities 1">My priorities 1</option>
                                       <option value="My priorities 2">My priorities 2</option>
                                       <option value="My priorities 3">My priorities 3</option>
                                   </select>
                               </div>
                           </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection