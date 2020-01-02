<style>
	*{
		font-family: 微軟正黑體;
	}
</style>
<h3>您好! {{ $user->name }}</h3>
<p>
	請點擊以下連結來重設您的密碼!<br>
	<a href="{{ url('active').'/'.$user->email.'/'.$code }}">重設密碼</a>
</p>