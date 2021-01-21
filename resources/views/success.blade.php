@extends('front.layouts.default')
@section('title', 'Post Event Page')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@section('content')
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
<div class="container">
    <h2 class="big-title">Event Posted Successfully</h2>

    	

 <div class="alert alert-success">
	                <ul>
	                    <li>{{$success}}</li>
	                    <li class="text-center" ><a href="{{ url('/events/'.$id.'/details/'.preg_replace('/\s+/', '_', $name)) }}" class="btn common-btn" >Link Of your event</a></li>
	                </ul>
	            </div>

 <div class="alert alert-success">
	                <ul>
	                    <li class="text-center" ><a href="https://www.way2conference.com/buy">PAID Advertisement Services</a></li>
	                </ul>
	            </div>	            
	    
	
</div>

<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm"></div>
</div>
@stop
@section('js')
<!-- Jquery Validation Js -->
<script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<!-- Date Picker Js -->
<script src="{{ asset('admin/js/datepicker.min.js') }}"></script>
<script type="text/javascript">
    var countryId = {{$event->country_id ?? 0}};
    var stateId = {{$event->state_id ?? 0}};
    var cityId = {{$event->city_id ?? 0}};

    $.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ajaxSend(function(){
		$(".loading").removeClass('hide');
	});

	$(document).ajaxComplete(function(){
		$(".loading").addClass('hide');
	});



</script>
@stop