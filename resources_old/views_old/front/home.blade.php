@extends('front.layouts.default')
@section('title', 'Home Page')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-sm-8 col-xs-12 left-side">
			@if(isset($featured_events) && $featured_events->count() > 0)
			<section>
				<h2 class="big-title">Featured Events</h2>
				<div class="row">
					@foreach($featured_events as $event)
					<div class="col-md-4 col-sm-4">
					    <div class="box">
					        <a href="{{ url('/events/'.$event->id.'/details/'.preg_replace('/\s+/', '_', $event->title)) }}">
					        	<img class="img-responsive" src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/front/images/event.jpg'}}" alt="">
					        	<div class="info-wrap"> 
						        	<h4 class="title">{{$event->title}}</h4>
						        	<small class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i>{{isset($event->city->state->country->name) ? $event->city->state->country->name.', ' : ''}} {{isset($event->city->name) ? $event->city->name : ''}}</small>
					        	</div>
					        </a>
					    </div>
					</div>
					@endforeach
				</div>
			</section>
			@endif

			@if(isset($popular_events) && $popular_events->count() > 0)
			<section>
				<h2 class="big-title">Popular Events</h2>
				<div class="row">
					@foreach($popular_events as $event)
					<div class="col-md-4 col-sm-4">
					    <div class="box">
					        <a href="{{ url('/events/'.$event->id.'/details/'.preg_replace('/\s+/', '_', $event->title)) }}">
					        	<img class="img-responsive" src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/front/images/event.jpg'}}" alt="">
					        	<div class="info-wrap"> 
						        	<h4 class="title">{{$event->title}}</h4>
						        	<small class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i>{{isset($event->city->state->country->name) ? $event->city->state->country->name.', ' : ''}} {{isset($event->city->name) ? $event->city->name : ''}}</small>
					        	</div>
					        </a>
					    </div>
					</div>
					@endforeach
				</div>
			</section>
			@endif
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12 right-side">
			<section>
				<h2 class="big-title">Browse Events</h2>
				<section class="box" id="city_box">
				    <div class="table-responsive no-b">
				    	@if(isset($cities) && $cities->count() > 0)
				        <table class="table-condensed">
				            <thead>
				                <tr>
				                    <td colspan="2"><b>Popular cities</b></td>
				                </tr>
				            </thead>
				            <tbody id="changecity">
				            	@php $count = 1; @endphp
				            	@foreach($cities as $city)
					            	@if($count%2 == 1)
					                <tr>
					                @endif
					                    <td style="width: 50%;"><i class="fa fa-fw fa-genderless text-muted mr-5"></i><a href="/search?city={{str_replace(' ', '_', str_replace('&', '$', $city->name))}}">{{$city->name}}</a></td>
					                @if($count%2 == 0)
					                </tr>
					                @endif
					                @php ++$count; @endphp
				                @endforeach
				            </tbody>
				        </table>
				        @endif
				    </div>
				    <hr>
				    @if(isset($countries) && $countries->count() > 0)
				    <div class="table-responsive no-b">
				        <table class="table-condensed ">
				        	<thead>
				                <tr>
				                    <td colspan="2"><b>Popular countries</b></td>
				                </tr>
				            </thead>
				            <tbody>
				                @php $count = 1; @endphp
				            	@foreach($countries as $country)
					            	@if($count%2 == 1)
					                <tr>
					                @endif
					                    <td style="width: 50%;"><i class="fa fa-fw fa-genderless text-muted mr-5"></i><a href="/search?country={{str_replace(' ', '_', str_replace('&', '$', $country->name))}}">{{$country->name}}</a></td>
					                @if($count%2 == 0)
					                </tr>
					                @endif
					                @php ++$count; @endphp
				                @endforeach
				            </tbody>
				        </table>
				        <!-- <hr>
				        <div class="text-center"><a href="#"><b>Browse All Countries</b></a></div> -->
				    </div>
				    @endif
				</section>

				@if(isset($categories) && $categories->count() > 0)
				<h2 class="big-title">Collections</h2>
				<section class="box">
				    <div class="table-responsive no-b">
				        <table class="table-condensed" id="texts">
				            <tbody>
				            	@foreach($categories as $category)
				                <tr>
				                    <td><i class="fa fa-fw mr-5 {{$category->icon_name}} text-muted"></i><a href="/search?category={{ str_replace(' ', '_', str_replace('&', '$', $category->name))}}">{{$category->name}}</a></td>
				                </tr>
				                @endforeach
				            </tbody>
				        </table>
				        <hr>
				        <div class="text-center"><a href="#"><b>All Categories</b></a></div>
				    </div>
				</section>
				@endif
			</section>
		</div>
	</div>
</div>
<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm">

    </div>    
</div>
@stop
