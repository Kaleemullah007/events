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
					        	<img class="img-responsive" src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/front/images/event'. mt_rand(0,24). '.jpg'}}" alt="">
					        	<div class="info-wrap" style="max-height:70px; " > 
						        	<!--<h4 class="title"> {{substr($event->title,0,25)}}</h4>-->
						        	<h4 class="title"> {{substr($event->title,0,45)}}</h4>
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
					  <?php  if(empty($event->title)) continue; ?>
					<div class="col-md-4 col-sm-4">
					    <div class="box" style="
max-height: 300px !important;
    min-height: 210px !important;
    max-width: 190px;
    min-width: 190px;

					    " >
					        <a href="{{ url('/events/'.$event->id.'/details/'.preg_replace('/\s+/', '_', $event->title)) }}">
					        	<img class="img-responsive" src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/front/images/event'. mt_rand(0,24). '.jpg'}}" alt="">
					        	<div class="info-wrap">
						        	<!--<h4 class="title">{{substr($event->title,0,25)}}</h4>-->
						        	<h4 class="title">{{substr($event->title,0,45)}}</h4>
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
				            	<?php 
				            	$city_2 = $city->City;	
				            	if($city_2==null)
				            		continue;			
				            	?>	
				            	

					            	@if($count%2 == 1)
					                <tr>
					                @endif
					                    <td style="width: 40%;"><i class="fa fa-fw fa-genderless text-muted mr-5"></i><a href="/search?city={{str_replace(' ', '_', str_replace('&', '$', $city_2->name))}}">{{$city_2->name}}</a></td>
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
				        <table class="table-condensed toptable" id="texts">
				            <tbody>
				            	@foreach($categories as $category)
				                <tr>
				                    <td><a href="/search?category={{ str_replace(' ', '_', str_replace('&', '$', $category->name))}}">{{$category->name}}</a> <i class="fa fa-plus mr-5 {{$category->icon_name}} text-muted" rel="fa fa-plus" id="<?=$category->id?>" onclick="showNestedCat(this.id)" ></i>
@foreach ($category->childrenCategories as $childCategory)
            @include('child_category', ['child_category' => $childCategory,'id'=>$category->id])
        @endforeach
				   <!--                  	
				                    <tr style="display: none" class="<?=$category->id?>" >
				                    	<td>Hell</td>
				                    </tr>				                    	
 -->

				                    </td>
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
<script type="text/javascript">
	function showNestedCat(id){
		var label = $("#"+id).attr('rel');
		if(label == 'fa fa-plus'){
			// $("#"+id).html('-');
			$("#"+id).removeClass('fa fa-plus');
			$("#"+id).addClass('fa fa-minus');
			$("#"+id).attr('rel', 'fa fa-minus');
			$("."+id).css({
				"display":"block"
			});
		}else{
			$("#"+id).removeClass('fa fa-minus');
			$("#"+id).addClass('fa fa-plus');
			$("#"+id).attr('rel', 'fa fa-plus');
			$("."+id).css({
				"display":"none"
			});
		}



	}
</script>