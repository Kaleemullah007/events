@extends('front.layouts.default')
@section('title', 'Register Page')
@section('content')
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
<div class="inner-page-content no-padding">
    <div class="contact-us-main">
        <div class="contact-us-inner register-inner">
            <div class="container">
                <div class="row">
                    <h2 class="text-center">Create account</h2>
                    <p class="text-center">Please fill up all details for Register.</p>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="POST" action="{{ route('register') }}" name="register">
                                @csrf
                                
                                
                                <div class="form-group">
                                    <label class="control-label" for="signupName">Name * </label>
                                    <input id="firstName" type="firstName" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required>
                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="signupEmail">Email Address * </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="signupPassword">Password *</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
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
                                    <input type="submit" name="action" class="btn btn-info btn-block" value="Create your account">
                                </div>
                                <p class="text-center">Already have an account? <a href="{{ route('login') }}"><b>Sign in</b></a></p>
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