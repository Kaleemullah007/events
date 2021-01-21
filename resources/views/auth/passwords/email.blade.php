@extends('front.layouts.default')
@section('title', 'Forgot Password Page')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <style>
     #g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}
</style>

@section('content')
<div class="inner-page-content no-padding">
    <div class="contact-us-main">
        <div class="contact-us-inner register-inner">
            <div class="container">
                <div class="row">
                    <h2 class="text-center">Forgot Password</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="POST" action="{{ route('password.email') }}" class="login-form">
                                <div class="form-group">
                                    <h2 class="text-center"></h2>
                                </div>
                                @csrf
                                <div class="form-group">
                                    <label>E-Mail Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                                                        <div class="g-recaptcha" data-sitekey="6LdrDu4UAAAAAPSCjiKNNtyi_M6DAJQ9L2A37GXC"></div>
                                     <span class="invalid-feedback" role="alert">
                                         
                                         @error('g-recaptcha-response')
                                         <strong>{{ $message }}</strong>
                                         @enderror
                                        </span>
                                    <button type="submit" n="" class="btn btn-info btn-block">Send Password Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
</script>
@stop


