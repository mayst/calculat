<div id="register-popup" class="register-popup mfp-hide zoom-anim-dialog">
    <h2>Quic Register</h2>
    <form action="{{ route('register') }}" method="POST" class="register-form">
        {{ csrf_field() }}

        <input type="text" class="form-controll" name="name" value="{{ old('name') }}" required autofocus placeholder="Your name">
        <input type="email" class="form-controll" name="email" value="{{ old('email') }}" required placeholder="Email">
        <input type="password" class="form-controll" name="password" required placeholder="Password">
        <input type="password" class="form-controll" name="password_confirmation" required placeholder="Repeat password">
        <div class="checkbox-block">
            <input id="register-checkbox" type="checkbox" class="checkbox">
            <label for="register-checkbox">I accept the terms and conditions</label>
        </div>
        <button class="purple-btn">Register</button>
    </form>
</div>

<div id="login-popup" class="login-popup mfp-hide zoom-anim-dialog">
    <h2>Log in</h2>
    <form action="{{ route('login') }}" method="POST" class="register-form">
        {{ csrf_field() }}

        <input type="email" class="form-controll" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
        <div class="form-group">
            <a href="{{ route('password.request') }}">Forgot your password?</a>
            <input type="password" class="form-controll" name="password" required placeholder="Password">
        </div>
        <button class="purple-btn">Log in</button>
    </form>
    <p class="no-acc">No account? <a href="#">Register now</a><br>or continue with</p>
    <div class="soc-login">
        <a href="#"><img src="/images/fb1.png" alt=""></a>
        <a href="#"><img src="/images/gp1.png" alt=""></a>
    </div>
</div>