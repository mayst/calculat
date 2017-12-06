<div id="register-popup" class="register-popup mfp-hide zoom-anim-dialog">

    <h2>Registration</h2>

    <form action="{{ route('register') }}" method="post" class="register-form">
        {{ csrf_field() }}
        <input type="text" class="form-controll" name="name" value="{{ old('name') }}" required autofocus placeholder="Your name">
        <input type="email" class="form-controll" name="email" value="{{ old('email') }}" required placeholder="Email">
        <input type="password" class="form-controll" name="password" required placeholder="Password">
        <input type="password" class="form-controll" name="password_confirmation" required placeholder="Repeat password">
        <div class="checkbox-block">
            <input id="register-checkbox" type="checkbox" class="checkbox" required>
            <label for="register-checkbox">I accept the terms and conditions</label>
        </div>
        <button type="submit" class="purple-btn">Register</button>
    </form>

</div>

<div id="login-popup" class="login-popup mfp-hide zoom-anim-dialog">

    <h2>Log in</h2>

    <form action="{{ route('login') }}" method="post" class="register-form">
        {{ csrf_field() }}
        <input type="email" class="form-controll" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
        <div class="form-group">
            <a href="{{ route('password.request') }}">Forgot your password?</a>
            <input type="password" class="form-controll" name="password" required placeholder="Password">
        </div>
        <button type="submit" class="purple-btn">Log in</button>
    </form>

    <p class="no-acc">No account? <a href="#register-popup" class="popup-content">Register now</a><br>or continue with:</p>

    <div class="text-center margin-bottom-20 additional-authorization-variant" id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email,nickname,photo,country;providers=facebook,vkontakte,odnoklassniki,mailru;hidden=other; redirect_uri={{ urlencode('http://' . $_SERVER['HTTP_HOST']) }}/ulogin;mobilebuttons=0;">
    </div>

</div>