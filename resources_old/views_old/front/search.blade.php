@extends('front.layouts.default')
@section('title', 'Home Page')
@section('content')

@php
$cityUrl = (isset($search['country']) && $search['country'] != '') ? 'country='.$search['country'] : '';
$cityUrl .= (isset($search['category']) && $search['category'] != '') ? ($cityUrl != '' ? '&category='.$search['category'] : 'category='.$search['category']) : '';
$cityUrl .= $cityUrl != '' ? '&city=' : 'city=';

$categoryUrl = (isset($search['country']) && $search['country'] != '') ? 'country='.$search['country'] : '';
$categoryUrl .= (isset($city) && $city != '') ? ($categoryUrl != '' ? '&city='.$city : 'city='.$city) : '';
$categoryAllUrl = $categoryUrl;
$categoryUrl .= $categoryUrl != '' ? '&category=' : 'category=';

@endphp
<div class="container">
	<div class="row">
	    
		    @section('rightside')
		   
		                					@foreach($popular_events as $event)
					<div class="col-md-12 col-sm-12">
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
		    @endsection
		    @section('leftside')
		       <div class="col-md-12 col-sm-12">
		           <?php 
		           
		           
		           ?><h2 class="big-title"> Events</h2>
		           
		                             <a class=""  href="{{URL::to('/events-month/2021-01')}}">Jan 2021</a>
		                             </br>
							        <a  class="" href="{{URL::to('/events-month/2021-02')}}">Feb 2021</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2021-03')}}">March 2021</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2021-04')}}">April 2021</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-05')}}">May 2020</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-06')}}">June 2020</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-07')}}">July 2020</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-08')}}">Aug 2020</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-09')}}">Sep 2020</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-10')}}">Oct 2020</a>
							        </br>
							        <a  class="" href="{{URL::to('/events-month/2020-11')}}">Nov 2020</a>
							        </br>
							        <a class=""  href="{{URL::to('/events-month/2020-12')}}">Dec 2020</a>
							        
							        </br>
							        
							        
		    		</div>
		    <!--<section>-->
		        
				
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
					            	<!--@if($count%2 == 1)-->
					                <tr>
					                @endif
					                    <td style="width: 50%;"><i class="fa fa-fw fa-genderless text-muted mr-5"></i><a href="/search?{{$cityUrl}}{{str_replace(' ', '_', str_replace('&', '$', $city->name))}}">{{$city->name}}</a></td>
					                <!--@if($count%2 == 0)-->
					                </tr>
					                <!--@endif-->
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
					            	<!--@if($count%2 == 1)-->
					                <tr>
					                @endif
					                    <td style="width: 50%;"><i class="fa fa-fw fa-genderless text-muted mr-5"></i><a href="/search?country={{str_replace(' ', '_', str_replace('&', '$', $country->name))}}">{{$country->name}}</a></td>
					                <!--@if($count%2 == 0)-->
					                </tr>
					                <!--@endif-->
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
				                    <td><i class="fa fa-fw mr-5 {{$category->icon_name}} text-muted"></i><a href="/search?{{$categoryUrl}}{{str_replace(' ', '_', str_replace('&', '$', $category->name))}}">{{$category->name}}</a></td>
				                </tr>
				                @endforeach
				            </tbody>
				        </table>
				        <hr>
				        <!--<div class="text-center"><a href="/search?{{$categoryAllUrl}}"><b>All Categories</b></a></div>-->
				    </div>
				</section>
				@endif
			<!--</section>-->
			
		    @endsection
			
		<!--</div>-->
		<div class="col-md-12 col-sm-12 col-xs-12 left-side">
			@if(isset($events) && $events->count() > 0)
			<section>
				<h2 class="big-title">Events</h2>
				<div class="row">
					@foreach($events as $event)
					<div class="col-md-12 col-sm-12">
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
				<div class="row">
					<div class="col-md-12 col-sm-12 text-center">
						{{ $events->links() }}
					</div>
				</div>
			</section>
			@else
				<div class="row">
					<div class="col-md-12 col-sm-12 text-center">
						<div class="alert alert-danger margin-top-65" role="alert">
							<h3>No event found.</h3>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm">
    
    </div>    
</div>
@stop
