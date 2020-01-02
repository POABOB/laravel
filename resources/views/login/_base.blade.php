<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewpost" content="device-width; maximum-scale=1">
	<title>@yield('title','彰師大二手書交易平台')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/resources/views/login/static/style.css') }}">
	<!-- hreader -->

	<link rel="stylesheet" type="text/css" href="{{ asset('/resources/views/login/static/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<script type="text/javascript" src="{{ asset('/resources/views/login/static/jquery-3.2.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/resources/views/login/static/responsive_navbar.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('/resources/views/login/static/responsive_navbar.css') }}">
	@yield('head')
	
</head>
	@yield('style')
	@yield('nav')
<body>
	@yield('carousel')
	@yield('category')
	@yield('container')
</body>
	@yield('script')
</html>