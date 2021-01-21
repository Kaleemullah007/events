<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if(isset($event) && $event->title && $event->short_description)
<meta name="description" content="{{$event->short_description}}" />
<meta name="title" content="{{$event->title}}">
@endif
<meta name="keywords" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="shortcut icon" type="image/ico" href="{{ url('/front/images/favicon.ico')}}" />

<link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/normalize.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/flag-icon.min.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/webslidemenu.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">
<!-- Date Picker CSS -->
<link rel="stylesheet" href="{{ asset('admin/css/datepicker.min.css') }}">
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&display=swap" rel="stylesheet">

<script data-ad-client="ca-pub-1532899052506773" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
