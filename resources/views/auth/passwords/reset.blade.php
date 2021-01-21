@endsection
@extends('front.layouts.default')
@section('title', 'Reset Password Page')
@section('content')
<div class="inner-page-content no-padding">
    <div class="contact-us-main">
        <div class="contact-us-inner register-inner">
            <div class="container">
                <div class="row">
                    <h2 class="text-center">Reset Password</h2>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                                <div class="form-group">
                                    <h2 class="text-center"></h2>
                                </div>
                                @csrf
                                <div class="form-group">
                                    <label>E-Mail Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="action">
                                    <button type="submit" n="" class="btn btn-info btn-block">Reset Password</button>
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