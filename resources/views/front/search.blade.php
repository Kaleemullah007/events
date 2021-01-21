@extends('front.layouts.search')
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
<style type="text/css">
	.common-btn-width{
		min-width: 170px;
	}
</style>
@section('leftside')
		       <div class="col-md-12 col-sm-12">
		           <h2 class="big-title"> Events</h2>
		           <div class="list-group">
		           	<?php
$country = $_GET['country']??'';
$city =   $_GET['city']??'';
$category = $_GET['category']??'';

$month = array(
'1'=>'Jan',
'2'=>'Feb',
'3'=>'March',
'4'=>'April',
'5'=>'May',
'6'=>'June',
'7'=>'July',
'8'=>'Aug',
'9'=>'Sep',
'10'=>'Oct',
'11'=>'Nov',
'12'=>'Dec'
);
    foreach ($dates as $date) {
    	
$name = $month[$date->month].' '.$date->year;
$date_link =  $date->year.'-'.$date->month;
?>
<a class="list-group-item common-btn"  style="width: 185px !important"   href="{{URL::to('/events-month/')}}/<?=$date_link?>?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">{{$name}}</a>
<?php 

    }


		           	 ?>





<!-- 
		                             <a class="list-group-item common-btn"  style="width: 185px !important"   href="{{URL::to('/events-month/2021-01')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Jan 2021</a>
		                             
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2021-02')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Feb 2021</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2021-03')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">March 2021</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2021-04')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">April 2021</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-05')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">May 2020</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-06')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">June 2020</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-07')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">July 2020</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-08')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Aug 2020</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-09')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Sep 2020</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-10')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Oct 2020</a>
							        
							        <a  class="list-group-item common-btn"  style="width: 185px !important"  href="{{URL::to('/events-month/2020-11')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Nov 2020</a>
							        
							        <a class="list-group-item common-btn"  style="width: 185px !important"   href="{{URL::to('/events-month/2020-12')}}?city=<?=$city?>&country=<?=$country?>&category=<?=$category?>">Dec 2020</a>
							        
							         -->
							    </div>
							        
							        
		    		</div>
		    
		    @endsection

<!-- Left Column End -->

<!-- Content Start -->

@section('content')

<style type="text/css">
	


/*.info-wrap img {
  float: left;
  width: 50px;
  height: 50px;
  bottom: 10px;
  
}

.info-wrap h4,small {
  position: relative;
  top: 0px;
  left: 30px;
}*/

small {
display: block;
line-height: 1.428571429;
color: #999;
}


</style>
		<div class="col-md-12 col-sm-12 col-xs-12">
<h2 class="big-title">Events</h2>
							<div class="col-md-12">
								<?php if(count($cities)> 0){ ?>
								<div class="box">
								@foreach($cities as $city)
				            	<?php 
				            	$city_2 = $city->City;	
				            	if($city_2==null)
				            		continue;			
				            	?>	
								<a href="/search?city={{str_replace(' ', '_', str_replace('&', '$', $city_2->name))}}"  class="btn btn-primary" role="button" >{{$city_2->name}}</a>
								@endforeach
							</div>
						<?php } ?>
								</div>



			@if(isset($events) && $events->count() > 0)
			<section>

				<div class="row">
					@foreach($events as $event)
					<div class="col-md-12 col-sm-12">
					    <div class="box">
					        <a href="{{ url('/events/'.$event->id.'/details/'.preg_replace('/\s+/', '_', $event->title)) }}">





					        	



					        	<div class="info-wrap"> 


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <img class="img-responsive" src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/front/images/event.jpg'}}" alt="" >
                    </div>
                    <div class="col-sm-12 col-md-10">
                    	<h3><?=Helper::getDay($event->start_date,'name')?>, <?=Helper::getDay($event->start_date,'date');?> - <?=Helper::getDay($event->end_date,'name')?>, <?=Helper::getDay($event->end_date,'date');?> <?=Helper::getDay($event->end_date,'month');?> <?=Helper::getDay($event->end_date,'year');?>  <?php $remainDay = Helper::dateDifference(date('Y-m-d'),$event->start_date);?> <?=($remainDay > 0)?"(".$remainDay.' days)':''; ?></h3>
                        <h4>{{$event->title}}</h4>
                        
                        <p>
                            	<small class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i>{{isset($event->city->state->country->name) ? $event->city->state->country->name.', ' : ''}} {{isset($event->city->name) ? $event->city->name : ''}}</small>
						        	<p>{{$event->venue}}</p>
                        </p>
  
                    </div>
                </div>
            </div>
        </div>
    </div>






					        		
						        
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

@endsection


<!-- End Content -->

<!-- Right Column -->
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
<!-- End Right COlumn -->

</div>

<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm">
    
    </div>    
</div>
@stop
