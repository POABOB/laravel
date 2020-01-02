<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','彰師大二手書交易平台')</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	@yield('head')
	<link rel="stylesheet" href="{{asset('/resources/views/admin/static/style.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	@yield('style')
	<style>
	.dropdown1{
		display: flex;
		justify-content: center;
	}
	.dropdown-content1 {
	  display: none;
	  position: absolute;
	  background-color: #f9f9f9;
	  min-width: 90px;
	  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	  z-index: 1;
	  right: 20px;
	  margin-top: 10px;
	  text-align: center;
	  padding: 10px 16px 10px 16px;
	}
	.dropdown-content1 a{
		padding: 10px 16px 10px 16px;
		display:block;
		
	}



	</style>
</head>
	<body>
	<!-- The menu bar -->
	<section id="sidebar">
		<div>
			<img src="{{asset('/resources/views/admin/static/kodinger1.png')}}" alt="">
		</div>
		@yield('nav')
	</section>
	<!-- header -->
	<header>
		<div class="search">
			<i class="fa fa-search"></i>
			@yield('search')
			<!-- <input class="search" type="text"> -->
		</div>
		<div class="user-field">
			<a href="{{url('/admin/addgoods')}}" class="add">+ Add</a>
			<a href="#" class="notification">
				<i class="fa fa-bell"></i><span class="circle">2</span>
			</a>
			<a href="#" class="dropdown1">
				<img src="{{ $data['avatar'] }}" class="user-img" alt="">
				<i class="fa fa-caret-down"></i>
				<div class="dropdown-content1">
					<p><a href="{{ url('/') }}">首頁</a></p>
					<p><a href="{{ url('/member') }}">會員</a></p>
					<p><a href="{{ url('/member/logout') }}">登出</a></p>
				</div>
			</a>
		</div>
	</header>
	<!-- content -->
	@yield('container')
	</body>

	<script type="text/javascript">
	$(document).ready(function(){
		$("#sidebar a").click(function(){
              $("#sidebar a").removeClass("active");
              $(this).addClass("active");
		});
		var click = 0;
		$(".dropdown1").click(function(){
			if(click == 0)
			{
				$(".dropdown-content1").css("display", "block");
				click = 1;
			}
			else if(click == 1)
			{
				$(".dropdown-content1").css("display", "none");
				click = 0;
			}
		});

	});
	</script>
	@yield('script')

</html>