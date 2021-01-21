@extends('front.layouts.default')
@section('title', 'About Us Page')
@section('content')
<div class="container">
    <div class="row">
    	<div class="col-sm-6">
    		<h2></h2>
    		<img src="{{ url('/front/images/about.jpg')}}" alt="" class="img-responsive">
    	</div>
        <div class="col-sm-6">
            <div class="left-side">
                <h2 class="big-title">About Us</h2>
                <div class="diff-bg">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm"></div>    
</div>
@stop