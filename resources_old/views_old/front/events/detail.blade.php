@extends('front.layouts.default')
@section('title', 'Post Event Page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="big-title">Conference Details</h2>
            <div class="bg-with-shadow common-confo-details">
                <div class="media">
                    <div class="media-body">
                        <div itemscope="" itemtype="http://data-vocabulary.org/Event">
                            @csrf
                        	<div class="top-info-wrap">
                        		<div class="event-img-left">
		                            <p>
		                                <img src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/admin/img/figure/parents.jpg'}}" width="150px" height="150px" title=" 2nd International Conference on Veterinary &amp; Animal Science" alt="{{$event->title}} &amp; {{isset($event->categories[0]) ? $event->categories[0]->name : ''}}" class="media-object">
		                            </p>
		                        </div>
                                <h4 class="confo-title"><span itemprop="name"> {{$event->title}} &amp; {{isset($event->categories[0]) ? $event->categories[0]->name : ''}}</span></h4>
                                <p><span>Date :</span>
                                    <time itemprop="startDate" datetime="{{$event->start_date}}">
                                        {{\Carbon\Carbon::parse($event->start_date)->isoFormat('Do MMM YYYY')}} </time>
                                    <time itemprop="endDate" datetime="{{$event->end_date}}">
                                        to {{\Carbon\Carbon::parse($event->end_date)->isoFormat('Do MMM YYYY')}}
                                        <br>
                                    </time>
                                </p>
                                @isset($event->city->name)
                                <p><span>Place :</span>
                                    <span itemprop="location">{{$event->city->state->country->name ?? ''}}, {{$event->city->name}}	</span>
                                </p>
                                @endisset
                            </div>
                            <div class="top-info-wrap white-bg">
                            <h4 class="confo-title">Other Details</h4>
                            <p><span>Website :</span><a href="{{$event->website_address}}" rel="nofollow" target="_blank" itemprop="url">{{$event->website_address}}</a></p>
                            <p><span>Contact Person:</span>{{$event->contact_person}}</p>
                            <p><span>Description:</span></p><span itemprop="description">{{$event->short_description}}</span>
                            
                            </div>
                            <div class="top-info-wrap white-bg">
                            <h4 class="confo-title">Event Summary</h4>
                            <br/>
                            <span itemprop="summary">{{$event->title}} &amp; {{isset($event->categories[0]) ? $event->categories[0]->name : ''}} will be held in {{$event->city->name}},{{$event->city->state->country->name ?? ''}} on date {{$event->start_date}}</span>
                            
                            <p><span>Deadline for abstracts/proposals : </span>{{\Carbon\Carbon::parse($event->abstract)->isoFormat('Do MMM YYYY')}}</p>
                            <div itemscope="" itemtype="http://data-vocabulary.org/Organization">
                                <span itemprop="name">
									<p><span>Organized By :</span>{{$event->organizing_society}}</p>
                                </span>
                            </div>
                            <p><span>Keynote Speakers :</span> {{$event->keynote_speakers ?? ''}}</p>
                            <p><span>Conference Highlights :</span>{{$event->conference_highlights ?? ''}}</p>
                            <p><span>Venue :</span><mark>{{$event->venue ?? ''}}</mark></p>
                            <p>Check the <a href="{{$event->website_address}}" target="_blank" itemprop="url">event website</a> for more details.</p>
                            @if (Auth::check())
                            <a href="javascript:void(0)" data-event_id="{{$event->id}}" class="addWishList"> <h3>Add to wishlist</h3></a>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="views-block pull-right">
                        <span class="views-title">Views:</span>
                        <span class="views-number">897</span>
                    </div>
                </div>
            </div>
            <center>
            </center>
            @isset($event->venue)
            <h2 class="big-title">Venue - Map &amp; Directions</h2>
            <div class="map-warp">
                <iframe width="1000" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBQZfR7z56ZWcUre-EZ3m-9zS1sI797mko&amp;q={{$event->venue ?? ''}}">
                </iframe>
            </div>
            @endisset
        </div>
    </div>
</div>
<div class="container">
    <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop" data-width="100%" data-numposts="5" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=1523810714360670&amp;container_width=938&amp;height=100&amp;href=https%3A%2F%2Fwww.allconferencealerts.com%2Fconference_details%2F104895%2F2nd-international-conference-on-veterinary-amp-animal-science&amp;locale=en_US&amp;numposts=5&amp;sdk=joey&amp;title=2nd%20International%20Conference%20on%20Veterinary%20%26%20Animal%20Science&amp;url=https%3A%2F%2Fwww.allconferencealerts.com%2Fconference_details%2F104895%2F2nd-international-conference-on-veterinary-amp-animal-science&amp;version=v2.8&amp;xid=https%253A%252F%252Fwww.allconferencealerts.com%252Fconference_details%252F104895%252F2nd-international-conference-on-veterinary-amp-animal-science" style="width: 100%;"><span style="vertical-align: bottom; width: 100%; height: 178px;"><iframe name="f24dc608619c58c" width="1000px" height="100px" title="fb:comments Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.8/plugins/comments.php?app_id=1523810714360670&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D45%23cb%3Df7b685c87459dc%26domain%3Dwww.allconferencealerts.com%26origin%3Dhttps%253A%252F%252Fwww.allconferencealerts.com%252Ff3eaac89ff32d%26relation%3Dparent.parent&amp;container_width=938&amp;height=100&amp;href=https%3A%2F%2Fwww.allconferencealerts.com%2Fconference_details%2F104895%2F2nd-international-conference-on-veterinary-amp-animal-science&amp;locale=en_US&amp;numposts=5&amp;sdk=joey&amp;title=2nd%20International%20Conference%20on%20Veterinary%20%26%20Animal%20Science&amp;url=https%3A%2F%2Fwww.allconferencealerts.com%2Fconference_details%2F104895%2F2nd-international-conference-on-veterinary-amp-animal-science&amp;version=v2.8&amp;xid=https%253A%252F%252Fwww.allconferencealerts.com%252Fconference_details%252F104895%252F2nd-international-conference-on-veterinary-amp-animal-science" style="border: none; visibility: visible; width: 100%; height: 178px;" class=""></iframe></span></div>
    <div class="bottom-sdie-ad">
    </div>
</div>
<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm"></div>    
</div>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('.addWishList').on('click', function(e){
            e.preventDefault();

            $(this).text('Saving...');
            $.ajax({
                /* the route pointing to the post function */
                url: '/events/addToWishList',
                type: 'POST',
                data: {event_id: $(this).data('event_id')},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) { 
                    
                    if(data.status == 200){
                        $('.addWishList').text('Saved');
                        setTimeout(function(){ $('.addWishList').addClass('hide'); }, 3000);
                    }else{
                        $('.addWishList').text('Add to wishlist');
                    }
                }
            }); 
        });
    });
</script> 
@stop