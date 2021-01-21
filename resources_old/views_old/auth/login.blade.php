@extends('front.layouts.default')
@section('title', 'Login Page')
@section('content')
 
 </style>
<div class="inner-page-content no-padding">
    <div class="contact-us-main">
        <div class="contact-us-inner register-inner">
            <div class="container">
                <div class="row">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Please enter your credentials.</p>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="POST" name="signin" action="{{ route('login') }}" role="form">
                                <div class="form-group">
                                    <h2 class="text-center"></h2>
                                </div>
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="action">
                                    <button type="submit" n="" class="btn btn-info btn-block">Sign In</button>
                                    <p class="text-center text-muted">Don't have an account yet? <a href="{{ route('register') }}"><b>Sign up</b></a>.</p>
                                      <p class="text-center text-info"> 
                                      @if (Route::has('password.request'))
                    <a class="forgot-btn" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif.</p>
                                      
                                </div>
                                
                      
            
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop