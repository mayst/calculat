@extends('layouts.header')

@section('content')
    <section class="{{ Auth::guest() ? 'search' : 'reg-search-page' }}">
        <div class="container">
            @if(!Auth::guest())
                @include('side_menu')
            @endif
            @if(!Auth::guest()) <div class="reg-search"> @endif
                <div class="search-header">
                    <h2>Look for your dreams</h2>
                    <div class="search-form">
                        <input type="text" class="form-controll" id="name" placeholder="Search" autocomplete="off">
                        <button id="searchbn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <script>
                            searchbn.onclick = function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url('/find/byName') }}",
                                    headers: {
                                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: { name: $('#name').val() },
                                    success: function (data) {
                                        $('#result').html(data);
                                    }
                                });
                            };
                        </script>
                    </div>
                </div>
                <div class="search-main-form">
                    @if(Auth::guest())
                        <div class="row">
                            <div class="col-md-7">
                    @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name2" type="text" class="form-controll" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Marital Status</label>
                                <select name="status" id="status" class="select">
                                    <option value="Not married">Not married</option>
                                    <option value="Married">Married</option>
                                    <option value="Actively searching">Actively searching</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Children</label>
                                <select name="children" id="children" class="select">
                                    <option value="Have">Have</option>
                                    <option value="Haven`t">Haven`t</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="range-label">Height, m</label>
                                <div class="range-box">
                                    <div id="height-slider"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="range-label">Age</label>
                                <div class="range-box">
                                    <div id="age-slider"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="range-label">Weight, kg</label>
                                <div class="range-box">
                                    <div id="weight-slider"></div>
                                </div>
                            </div>
                        @if(Auth::guest())
                            </div>
                            <div class="col-md-5">
                        @endif
                            <div class="colors">
                                <div class="hair-color choose-color">
                                    <p>Hair color</p>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox1" type="checkbox" class="color-check no-color" name="color-checkbox1">
                                        <label for="color-checkbox1"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox2" type="checkbox" class="color-check light-yellow" name="hair">
                                        <label for="color-checkbox2"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox3" type="checkbox" class="color-check red" name="hair">
                                        <label for="color-checkbox3"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox4" type="checkbox" class="color-check pink" name="hair">
                                        <label for="color-checkbox4"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox5" type="checkbox" class="color-check brown" name="hair">
                                        <label for="color-checkbox5"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox6" type="checkbox" class="color-check grey" name="hair">
                                        <label for="color-checkbox6"></label>
                                    </div>
                                </div>
                                <div class="eye-color choose-color">
                                    <p>Eyes color</p>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox7" type="checkbox" class="color-check eye-blue" name="eye">
                                        <label title="blue" for="color-checkbox7"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox8" type="checkbox" class="color-check eye-green" name="eye">
                                        <label title="green" for="color-checkbox8"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox9" type="checkbox" class="color-check eye-grey" name="eye">
                                        <label title="grey" for="color-checkbox9"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox10" type="checkbox" class="color-check eye-light-grey" name="eye">
                                        <label for="color-checkbox10"></label>
                                    </div>
                                </div>

                                <button class="purple-btn" id="searchbo">Search</button>
                                <button type="reset" class="reset-btn">Reset filters</button>
                                <script>
                                    searchbo.onclick = function() {
                                        /*var hair_colors = [];
                                        for(var i = 1; i < 7; i++) {
                                            hair_colors.push($('#color-checkbox' + i).val());
                                        }
                                        console.log(hair_colors);*/

                                        $.ajax({
                                            type: "POST",
                                            url: "{{ url('/find/byOther') }}",
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: { name: $('#name2').val(),
                                                    status: $('#status').val(),
                                                    children: $('#children').val(),
                                                    min_height: $('#height-slider .noUi-base .noUi-origin .noUi-handle-lower .noUi-tooltip').html(),
                                                    max_height: $('#height-slider .noUi-base .noUi-origin .noUi-handle-upper .noUi-tooltip').html(),
                                                    min_age: $('#age-slider .noUi-handle-lower .noUi-tooltip').html(),
                                                    max_age: $('#age-slider .noUi-handle-upper .noUi-tooltip').html(),
                                                    min_weight: $('#weight-slider .noUi-handle-lower .noUi-tooltip').html(),
                                                    max_weight: $('#weight-slider .noUi-handle-upper .noUi-tooltip').html()
//                                                    hair:
                                                    },
                                            success: function (data) {
//                                                console.log(data);
                                                $('#result').html(data);
                                            }
                                        });
                                    };
                                </script>
                            </div>
                        @if(Auth::guest()) </div> @endif
                    </div>
                </div>
            @if(!Auth::guest())
                {{--</div>--}}
            @else
                    <a href="#" class="mobile-hide"><i class="fa fa-angle-up" aria-hidden="true"></i>Hide filters</a>
                    </div>
            @endif
    </section>

    <div class="peoples">
        <div class="container">
        @if(Auth::guest())
                <div class="peoples-wrap">
        @endif
                <div class="row" id="result">
                    <script type="text/javascript">

                        $(function() {
                            $('body').on('click', '.pagination a', function(e) {
                                e.preventDefault();

//                                $('#load a').css('color', '#dfecf6');
//                                $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

                                var url = $(this).attr('href');
                                getArticles(url);
                                window.history.pushState("", "", url);
                            });

                            function getArticles(url) {
                                $.ajax({
                                    type: "POST",
                                    url : url,
                                    headers: {
                                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: { name: $('#name').val() }
                                }).done(function (data) {
                                    $('#result').html(data);
                                }).fail(function () {
                                    alert('Womans could not be loaded.');
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
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

    @if(!Auth::guest())
        @include ("modals.chat")
    @endif

@endsection