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
                                <label>Status</label>
                                <select name="status" id="status" class="select">
                                    <option value="Not married">Not married</option>
                                    <option value="Status 2">Status 2</option>
                                    <option value="Status 3">Status 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select name="Position" id="position" class="select">
                                    <option value="Position 1">Position 1</option>
                                    <option value="Position 2">Position 2</option>
                                    <option value="Position 3">Position 3</option>
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
                                        <input id="color-checkbox1" type="checkbox" class="color-check no-color" name="hair">
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
                                <div class="skin-color choose-color">
                                    <p>Skin color</p>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox11" type="checkbox" class="color-check skin1" name="skin">
                                        <label for="color-checkbox11"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox12" type="checkbox" class="color-check skin2" name="skin">
                                        <label for="color-checkbox12"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox13" type="checkbox" class="color-check skin3" name="skin">
                                        <label for="color-checkbox13"></label>
                                    </div>
                                    <div class="color-checkbox">
                                        <input id="color-checkbox14" type="checkbox" class="color-check skin4" name="skin">
                                        <label for="color-checkbox14"></label>
                                    </div>
                                </div>
                                <button class="purple-btn" id="searchbo">Search</button>
                                <button type="reset" class="reset-btn">Reset filters</button>
                                <script>
                                    searchbo.onclick = function() {
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ url('/find/byOther') }}",
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: { name: $('#name2').val(),
                                                    status: $('#status').val(),
                                                    position: $('#position').val(),
                                                    min_height: $('#height-slider .noUi-handle-lower .noUi-tooltip').val(),
                                                    max_height: $('#height-slider .noUi-handle-upper .noUi-tooltip').val(),
                                                    min_age: $('#age-slider .noUi-handle-lower .noUi-tooltip').val(),
                                                    max_age: $('#age-slider .noUi-handle-upper .noUi-tooltip').val(),
                                                    min_weight: $('#weight-slider .noUi-handle-lower .noUi-tooltip').val(),
                                                    max_weight: $('#weight-slider .noUi-handle-upper .noUi-tooltip').val()
    //                                                hair:
                                                    },
                                            success: function (data) {
                                                $('#result').html(data);
                                            }
                                        }).fail(function (data) {
                                            $('#result').html(data);
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
                </section>
            @endif

    <div class="peoples">
        <div class="container">
        @if(Auth::guest())
                <div class="peoples-wrap">
        @endif
                <div class="row" id="result">

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
                {{--<div class="pagination">
                    <ul class="pagination-list">
                        <li><a href="#">1</a></li>
                        <li><a href="#" class="active">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                    </ul>
                </div>--}}
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
@endsection