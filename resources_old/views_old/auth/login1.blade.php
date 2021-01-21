@extends('admin.layouts.login')

@section('content')
<div class="login-page-content">
    <div class="login-box">
        <div class="item-logo">
            <img src="{{ url('/admin/img/logo2.png')}}" alt="logo">
        </div>
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <i class="far fa-envelope"></i>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <i class="fas fa-lock"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember-me" class="form-check-label">Remember Me</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="forgot-btn" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="login-btn">Login</button>
            </div>
        </form>
    </div>
    <div class="sign-up">Don't have an account ? <a href="{{ route('register') }}">Signup now!</a></div>
</div>
@endsection
