<div class="black-bg"></div>
<div class="logo-and-search-box">
   <div class="container">
      <div class="row">
        <div class="col-sm-3 col-xs-12">
            <div class="logo">
               <a href="{{ url('/') }}" class="smallogo"><img src="{{ url('/front/images/logo.png')}}" alt="logo"></a>
            </div>
        </div>
        <div class="col-sm-9 col-xs-12">
        	<div class="top-menu">
			    <div class="col-sm-12 col-xs-12">
		            <div class="wsmenucontainer clearfix">
		               <a href="#" alt="">
		                  <div class="overlapblackbg"></div>
		               </a>
		               <div class="wsmobileheader clearfix">
                          <a id="wsnavtoggle" class="animated-arrow"><span></span></a>
		                  <a href="index.html" class="smallogo"><img src="{{ url('/front/images/logo.png')}}" alt="logo" width="120"></a>
		                  <a class="callusicon" href="#"><span class="fa fa-envelope"></span></a>
		               </div>
		               <div class="main-menu">
		                  <div class="wsmain">
		                     <nav class="wsmenu clearfix">
		                        <ul class="mobile-sub wsmenu-list">
                                    <li><a href="{{ url('/') }}">Home</a></li>
				                    <li><a href="{{ url('/about') }}">About</a></li>
				                    <li><a href="{{ url('/events/add') }}">Post Event</a></li>
				                    <li><a href="{{ url('/contact') }}">Contact</a></li>
				                    @if (Auth::check())
				                    <li><a href="{{ url('/admin/home') }}">{{Auth::user()->first_name}}</a></li>
				                    <li><a href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="flaticon-turn-off"></i>Log Out</a>
			                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                                @csrf
			                            </form>
			                        </li>
				                    @else
				                    <li><a href="{{ url('/register') }}">Register</a></li>
				                    <li><a href="{{ url('/login') }}">Login</a></li>
				                    @endif
		                        </ul>
		                     </nav>
		                  </div>
		               </div>
		            </div>
		        </div>
			</div>
        </div>
        <div class="col-sm-12">
        	<div class="input-group stylish-input-group home-search">
        		<h2 class="search-title">Find interesting trade shows & conferences to attend globally</h2>
			    <form id="search" type='GET' action="/search">
			        <input type="text" class="form-control" placeholder="Search by: Industry or event name" name="name" value="{{$search['name'] ?? ''}}">
			        <input type="hidden" name="category" value="{{$search['category'] ?? ''}}">
			        <input type="hidden" name="country" value="{{$search['country'] ?? ''}}">
			        <input type="hidden" name="city" value="{{$search['city'] ?? ''}}">
			        <span class="input-group-addon">
						<button type="submit">
						<i class="fa fa-search" aria-hidden="true"></i>
						Search
						</button>
					</span>
			    </form>
			</div>
        </div>
      </div>
   </div>
</div>