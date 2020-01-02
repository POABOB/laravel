<!DOCTYPE html>
<html>
<head>
	<title>後臺管理介面</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
	<body>
	<!-- The menu bar -->
	<section id="sidebar">
		<nav>
			<a href="#" class="active"><span><i class="fa fa-home"></i></span> 首頁</a>
			<a href="#"><span><i class="fa fa-sticky-note"></i></span> 訂單管理</a>
			<a href="#"><span><i class="fa fa-bookmark"></i></span> 商品管理</a>
			<a href="#"><span><i class="fa fa-calendar-check"></i></span> 出貨日期</a>
			<a href="#"><span><i class="fa fa-user-circle"></i></span> 買家管理</a>
			<a href="#"><span><i class="fa fa-cog"></i></span> 設定</a>
		</nav>
	</section>
	<!-- header -->
	<header>
		<div class="search">
			<i class="fa fa-search"></i>
			<input type="text">
		</div>
		<div class="user-field">
			<a href="#" class="add">+ Add</a>
			<a href="#" class="notification"><i class="fa fa-bell"></i><span class="circle">2</span></a>
			<a href="#">
				<div class="user-img">
				</div>
				<i class="fa fa-caret-down"></i>
			</a>
		</div>
	</header>
	<!-- content -->
	<div class="container">
		<!-- <iframe src="{{ url('/admin/dashboard') }}" frameborder="0"></iframe> -->
	</div>
	</body>
</html>