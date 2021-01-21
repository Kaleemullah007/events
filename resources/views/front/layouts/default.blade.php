<!DOCTYPE html>
<html lang="en">
<head>
 @include('front.includes.head')
</head>
<body>
<div class="loading hide">
        <!-- <h1>Loading...</h1> -->
        <img src="{{ url('/admin/img/loader.gif')}}">
    </div>
<div class="wrapper home">
    
	<div class="left-side-ad hidden-xs hidden-sm">
	   <!-- @yield('leftside') -->
	   
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- SCI-Vertical-160x600 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:160px;height:600px"
                         data-ad-client="ca-pub-1532899052506773"
                         data-ad-slot="6767218711"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>	   
	</div>
	<div class="right-side-ad hidden-xs hidden-sm">
	     <!-- @yield('rightside') -->

                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- SCI-Vertical-160x600 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:160px;height:600px"
                         data-ad-client="ca-pub-1532899052506773"
                         data-ad-slot="6767218711"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

	</div>
	<header>
		@include('front.includes.header')
	</header>
	<section>
		@yield('content')
	</section>
	<footer>
        @include('front.includes.footer')
    </footer>
</div>
<!-- <div id="ii"></div> -->
<div class="back-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></div>


<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/webslidemenu.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/function.js') }}"></script>
@yield('js')
</body>
<script type="text/javascript">
	var text = '';
	// $('#texts td').each(function() {
    // var cellText = $(this).text();  
    // text +=cellText+'____';
   
// });
	// $("#ii").html(text);

</script>
<?php 
// $str = "Agriculture & Forestry____Animals & Pets____Apparel & Clothing____Arts & Crafts____Auto & Automotive____Baby, Kids & Maternity____Banking & Finance____Building & Construction____Business Services____Education & Training____Electric & Electronics____Entertainment & Media____Environment & Waste____Fashion & Beauty____Food & Beverages____Home & Office____Hospitality____IT & Technology____Industrial Engineering____Logistics & Transportation____Medical & Pharma____Miscellaneous____Packing & Packaging____Power & Energy____Science & Research____Security & Defense____Telecommunication____Travel & Tourism____Wellness, Health & Fitness____";
// $category = explode("____",rtrim($str,"____"));
// $data = array();
// foreach ($category as $value) {
// 	$data[]['name'] = $value;
// }

?>
</html>