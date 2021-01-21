@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Profile</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>My Profile</li>
    </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Profile Setting Area Start Here -->
<div class="card ui-tab-card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="basic-tab">
            <form class="new-added-form" id="profileForm" method="POST" enctype="multipart/form-data" action="{{ route('updateProfile') }}">
                @csrf
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>PROFILE DETAILS</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <div class="item-img-profile">
                            <img src="{{isset($profile->profile_image) ? asset('logos/profiles/'.$profile->profile_image) : '/admin/img/figure/parents.jpg'}}" alt="student" id="logoPreview">
                            <input type="file" class="mg-t-5" name="logo" id="logo" accept="image/*" class="form-control-file">
                        </div>
                    </div>
                </div>
                <div class="row mg-t-25">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Title *</label>
                        <select required name="title" class="form-control">
                            <option value="">Select</option>
                            <option value="Ms" {{ $profile->title == "Ms" ? "selected":"" }}>Ms</option>
                            <option value="Miss" {{ $profile->title == "Miss" ? "selected":"" }}>Miss</option>
                            <option value="Mrs" {{ $profile->title == "Mrs" ? "selected":"" }}>Mrs</option>
                            <option value="Mr" {{ $profile->title == "Mr" ? "selected":"" }}>Mr</option>
                            <option value="Master" {{ $profile->title == "Master" ? "selected":"" }}>Master</option>
                            <option value="Rev" {{ $profile->title == "Rev" ? "selected":"" }}>Rev</option>
                            <option value="Fr" {{ $profile->title == "Fr" ? "selected":"" }}>Fr</option>
                            <option value="Dr" {{ $profile->title == "Dr" ? "selected":"" }}>Dr</option>
                            <option value="Atty" {{ $profile->title == "Atty" ? "selected":"" }}>Atty</option>
                            <option value="Prof" {{ $profile->title == "Prof" ? "selected":"" }}>Prof</option>
                            <option value="Hon" {{ $profile->title == "Hon" ? "selected":"" }}>Hon</option>
                            <option value="Pres" {{ $profile->title == "Pres" ? "selected":"" }}>Pres</option>
                            <option value="Gov" {{ $profile->title == "Gov" ? "selected":"" }}>Gov</option>
                            <option value="Sir" {{ $profile->title == "Sir" ? "selected":"" }}>Sir</option>
                        </select>
                    </div>
                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>First Name *</label>
                        <input id="firstName" type="text" class="form-control" name="first_name" value="{{ $profile->first_name ?? '' }}">
                    </div>
                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Last Name *</label>
                        <input id="lastName" type="last_name" class="form-control" name="last_name" value="{{ $profile->last_name ?? '' }}">
                    </div>
                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Country *</label>
                        <select class="form-control" required="" name="country_id">
                            <option value="">Select</option>
                            @if(isset($countries) && $countries->count() > 0)
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{ $profile->country_id == $country->id ? "selected":"" }}>{{$country->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Field of work/interest </label>
                        <input id="work" type="work" class="form-control" name="work" value="{{ $profile->work ?? '' }}">
                    </div>
                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Username *</label>
                        <input id="userName" type="user_name" class="form-control" name="user_name" value="{{ $profile->user_name ?? '' }}">
                    </div>
                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>New Password ?</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="button" class="btn-fill-md text-light bg-dark-pastel-green radius-4" id="btnSave">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ asset('js/profile.js') }}"></script>
@stop