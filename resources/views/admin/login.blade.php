<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>彰師大二手書後台</title>
	<link rel="stylesheet" href="{{ asset('/resources/views/admin/static/auth.css')}}">
</head>
<style>
.socialgoogle{
	width: 220px;
	height: 36px;
	border: none;
	border-radius: 2px;
	color: #fff;
	text-align: center;
	font-family: 微軟正黑體, sans-serif;
	font-weight: 500;
	transition: 0.2s ease;
	cursor: pointer;
	background: #dd4b39;
}
.socialfacebook{
	margin: 14px;
	width: 220px;
	height: 36px;
	border: none;
	border-radius: 2px;
	color: #fff;
	text-align: center;
	font-family: 微軟正黑體, sans-serif;
	font-weight: 500;
	transition: 0.2s ease;
	cursor: pointer;
	background: #32508e;
}
div .media{
	text-align: center;
}
</style>
<body>
	<div class="lowin lowin-purple">
		<div class="lowin-brand">
			<img src="{{ asset('/resources/views/admin/static/kodinger.jpg')}}" alt="logo">
		</div>
		<div class="lowin-wrapper">
			<div class="lowin-box lowin-login">
				<div class="lowin-box-inner">
					<form action="" method="post">
						{{csrf_field()}}
						@if(session('msg'))
						<p style="color: red;">{{session('msg')}}</p>
						@endif
						<div class="lowin-group">
							<label>Email <a href="#" class="login-back-link">Sign in?</a></label>
							<input type="email" autocomplete="email" name="email" class="lowin-input">
						</div>
						<div class="lowin-group password-group">
							<label>密碼 <a href="#" class="forgot-link">忘記密碼?</a></label>
							<input type="password" name="password" autocomplete="current-password" class="lowin-input">
						</div>
						<div class="lowin-group">
							<label>驗證碼</label>
							<input type="text" name="captcha" class="lowin-input" style="vertical-align:middle; width: 200px;">

								<img src="{{url('/admin/captcha')}}" alt="" onclick="this.src='{{url('/admin/captcha')}}?'+Math.random()" style="cursor: pointer; vertical-align:middle;">

							
						</div>
						<button class="lowin-btn login-btn">
							登入
						</button>
					</form>
					<div class="media">
						<form method="get" action="{{ url('/auth/admin/facebook') }}">
							<button class="socialfacebook" type="submit">Facebook 登入</button><br>
						</form>
						<form method="get" action="{{ url('/auth/admin/google') }}">
							<button class="socialgoogle" type="submit">Google+ 登入</button>
						</form>
					</div>
				</div>
			</div>

		</div>
	
		<<!-- footer class="lowin-footer">
			Design By <a href="http://fb.me/itskodinger">@itskodinger</a>
		</footer> -->
	</div>

	<script src="{{ asset('/resources/views/admin/static/auth.js')}}"></script>
	<script>
		Auth.init({
			login_url: '#login',
			forgot_url: '#forgot'
		});
	</script>
</body>
</html>