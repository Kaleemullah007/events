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
                    <p>
                        <a href="https://www.way2conference.com">Way2Conference.com</a> is an exclusive online portal for getting information on all upcoming national and international academic conferences worldwide. People of all ages with one or many interests are free to browse this conference alerts website anytime, anywhere. This one-stop information counter provides free access to its huge database of conferences. Ranging from the date and venue to organizer details is being available on this web portal.
                        <br/><br/>
                        <b>ADVERTISEMENT / CONFERENCE GENERAL QUERIES MAIL US AT</b><br/>
<a href="mailto:office@way2conference.com">office@way2conference.com</a>
<br/><br/>
<b>CONFERENCE FEEDBACK / GENERAL QUERIES MAIL US AT</b><br/>
<a href="mailto:feedback@way2conference.com">feedback@way2conference.com</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm"></div>    
</div>
@stop