    @extends('layouts.header')

@section('content')
    <section class="{{ Auth::guest() ? 'search' : 'reg-search-page' }}">
        <div class="container">
            @if(!Auth::guest())
                @include('side_menu')
            @endif

                <div class="peoples favorites">
                    <div class="container">
                        <div>
                            <div class="row">
                                @foreach($users as $user)
                                <div class="col-sm-6 col-md-4">
                                    <a href="/profile/{{ $user->favoriteUser->id }}" class="single">
                                        <img src="/images/avatars/{{ $user->favoriteUser->user->avatar() }}" alt="">
                                        <span class="online"></span>
                                        <object><a href="#" class="star"><i class="fa fa-star" aria-hidden="true"></i></a></object>
                                        <div class="people-info">
                                            <div class="people-about">
                                                <p class="name">{{ $user->favoriteUser->user->name }}, <span class="age">23</span></p>
                                                <p class="address">{{ $user->user->info->city }}, {{ $user->user->info->country }}</p>
                                            </div>
                                            <object><a href="#" class="get-chat">Get Chat</a></object>
                                        </div>
                                        <div class="people-options"></div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <div class="pagination">
                                {{ $users->links() }}
                            </div>
                            {{--<script type="text/javascript">
                                $(function() {
                                    $('body').on('click', '.pagination a', function(e) {
                                        e.preventDefault();
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
                            </script>--}}
                        </div>
                    </div>
                </div>
        </div>
    </section>


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