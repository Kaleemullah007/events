@extends('admin.layouts.login')

@section('content')
<div class="login-page-content">
    <div class="login-box">
        <div class="item-logo">
            <img src="{{ url('/admin/img/logo2.png')}}" alt="logo">
        </div>
        <form method="POST" action="{{ route('register') }}" class="login-form">
            @csrf
            <div class="form-group">
                <label>Title *</label>
                <select class="select2" required name="title">
                    <option value="">Select</option>
                    <option value="Ms" {{ (old("title") == "Ms" ? "selected":"") }}>Ms</option>
                    <option value="Miss" {{ (old("title") == "Miss" ? "selected":"") }}>Miss</option>
                    <option value="Mrs" {{ (old("title") == "Mrs" ? "selected":"") }}>Mrs</option>
                    <option value="Mr" {{ (old("title") == "Mr" ? "selected":"") }}>Mr</option>
                    <option value="Master" {{ (old("title") == "Master" ? "selected":"") }}>Master</option>
                    <option value="Rev" {{ (old("title") == "Rev" ? "selected":"") }}>Rev</option>
                    <option value="Fr" {{ (old("title") == "Fr" ? "selected":"") }}>Fr</option>
                    <option value="Dr" {{ (old("title") == "Dr" ? "selected":"") }}>Dr</option>
                    <option value="Atty" {{ (old("title") == "Atty" ? "selected":"") }}>Atty</option>
                    <option value="Prof" {{ (old("title") == "Prof" ? "selected":"") }}>Prof</option>
                    <option value="Hon" {{ (old("title") == "Hon" ? "selected":"") }}>Hon</option>
                    <option value="Pres" {{ (old("title") == "Pres" ? "selected":"") }}>Pres</option>
                    <option value="Gov" {{ (old("title") == "Gov" ? "selected":"") }}>Gov</option>
                    <option value="Sir" {{ (old("title") == "Sir" ? "selected":"") }}>Sir</option>
                </select>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>First Name*</label>
                <input id="firstName" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Last Name*</label>
                <input id="lastName" type="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Country *</label>
                <select class="select2" required="" name="country_id">
                    <option value="">Please Select Country *</option>
                    @if(isset($countries) && $countries->count() > 0)
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{ (old("country_id") == $country->id ? "selected":"") }}>{{$country->name}}</option>
                        @endforeach
                    @endif
                </select>
                @error('country_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Field of work/interest</label>
                <input id="work" type="work" class="form-control @error('work') is-invalid @enderror" name="work" value="{{ old('work') }}">
                @error('work')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Username*</label>
                <input id="userName" type="user_name" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required>
                @error('user_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password*</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="login-btn">Signup</button>
            </div>
        </form>
    </div>
    <div class="sign-up">Already have an account ? <a href="{{ route('login') }}">Login!</a></div>
</div>
@endsection
