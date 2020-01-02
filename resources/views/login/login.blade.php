@extends('login._base')
@section('title', '彰師大二手書交易平台-註冊/登入')
@section('nav')
	<header>
		<nav>
			<div class="logo-section">
				<a href="{{ url('/') }}" class="logo">MARKET</a>
				<button class="hb-button"><i class="fa fa-bars"></i></button>
			</div>
			<ul>
				<li><a href="{{ url('/forgot') }}">忘記密碼</a></li>
				<!-- <li><a href="#"></a></li> -->
				<li><a href="{{ url('/cart') }}">購物車</a></li>
				<li><a href="{{ url('/') }}">首頁</a></li>
			</ul>
		</nav>
	</header>
@stop

@section('container')
	<div class="box">
		<div class="leftbox">
			<form action="{{ url('/register') }}" method="post" name="form1">
				<h2>註冊會員</h2>
				{{ csrf_field() }}
				<input type="text" name="username" placeholder="請輸入名稱..." value="{{ old('username') }}">
				<input type="text" name="email" placeholder="請輸入Email..." value="{{ old('email') }}" id="email" onkeyup="checkKeyUp()">
				<input type="password" name="password" placeholder="請輸入密碼...">
				<input type="password" name="passconf" placeholder="請再輸入密碼...">
				<!-- <div style="width: 220px; height: 32px; display: block;"> -->
					<input type="text" name="captcha" class="lowin-input" placeholder="請輸入驗證碼..." style="vertical-align:middle; width: 110px; display: inline-block;
">
				
					<img src="{{url('/admin/captcha')}}" alt="" onclick="this.src='{{url('/admin/captcha')}}?' + Math.random()" style="cursor: pointer;  width: 105px; margin-top: 0px;"><br>
				<!-- </div> -->
					<input type="submit" style="margin-bottom: 0px;" name="submit" value="送出">
					<div style="text-align: center;">
						<p style="padding: 0;margin: 0;padding-top: 5px" name="msg1" id="msg1">
						@if(session('msg1'))
							{{session('msg1')}}
						@endif
						<p>
					</div>

			</form>
		</div>
		<div class="line"></div>
		<div class="rightbox">
			<form action="{{ url('/login') }}" method="post" name="form2">
				<h2>登入會員</h2>
				{{ csrf_field() }}
				<input type="text" name="email" placeholder="請輸入Email..." value="{{ old('email') }}">
				<input type="password" name="password" placeholder="請輸入密碼...">
				<input type="text" name="captcha" class="lowin-input" placeholder="請輸入驗證碼..." style="vertical-align:middle; width: 110px; display: inline-block;
">
				
					<img src="{{url('/admin/captcha')}}" alt="" onclick="this.src='{{url('/admin/captcha')}}?' + Math.random()" style="cursor: pointer;  width: 105px; margin-top: 0px;"><br>

					<input type="submit" style="margin-bottom: 0px;" name="submit" value="送出">
					<div style="text-align: center;">
						<p style="padding: 0;margin: 0;padding-top: 5px">
						@if(session('msg2'))
							{{session('msg2')}}
						@endif
						<p>
					</div>

			</form>
			<form method="get" action="{{ url('/auth/facebook') }}">
				{{ csrf_field() }}
				<button class="socialfacebook" type="submit">Facebook 登入</button><br>
			</form>
			<form method="get" action="{{ url('/auth/google') }}">
				{{ csrf_field() }}
				<button class="socialgoogle" type="submit">Google+ 登入</button>
			</form>

		</div>
		<div class="or">OR</div>
		@if($errors->any())
			@foreach($errors->all() as $error)
				<input type="hidden" id=error name="errors" value="{{ $error }}">
			@endforeach
		@endif
		
	</div>
@stop
@section('script')
<script>
	/****************************************
 *		validate用來顯示錯誤的方法		*
 ****************************************/
var error = document.getElementById('error').value;
if((error.length)>0){ alert(error);}


/****************************************
 *		Ajax檢驗帳戶email是否重複			*
 ****************************************/

function checkKeyUp()
{
		// 當 document 結構已解析完成才會執行
		var email = document.form1.email.value;
		if(email.length > 0)
		{
			// ^\w+：@ 之前必須以一個以上的文字&數字開頭，例如 abc
			// ((-\w+)：@ 之前可以出現 1 個以上的文字、數字或「-」的組合，例如 -abc-
			// (\.\w+))：@ 之前可以出現 1 個以上的文字、數字或「.」的組合，例如 .abc.
			// ((-\w+)|(\.\w+))*：以上兩個規則以 or 的關係出現，並且出現 0 次以上 (所以不能 –. 同時出現)
			// @：中間一定要出現一個 @
			// [A-Za-z0-9]+：@ 之後出現 1 個以上的大小寫英文及數字的組合
			// (\.|-)：@ 之後只能出現「.」或是「-」，但這兩個字元不能連續時出現
			// ((\.|-)[A-Za-z0-9]+)*：@ 之後出現 0 個以上的「.」或是「-」配上大小寫英文及數字的組合
			// \.[A-Za-z]+$/：@ 之後出現 1 個以上的「.」配上大小寫英文及數字的組合，結尾需為大小寫英文
			var regx = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
			if(email.search(regx) != -1)
				checkEmail();
			else
				document.getElementById('msg1').innerHTML = '請輸入正確的Email格式!';
		}
		else if(email.length == 0)
		{
			document.getElementById('msg1').innerHTML = '';
		}

}



function checkEmail() 
{
	if (window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest(); //建立XMLHttpRequest物件
	else if (window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

	var url='{{ url('/checkEmail') }}' + '/'+ document.form1.email.value;
	 // + '&timeStamp='+new Date().getTime(); 
	xmlHttp.open('GET',url,true);//建立XMLHttpRequest連線要求
	xmlHttp.onreadystatechange=getResult; //指定處理程式
	xmlHttp.send(null);
}

function getResult()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=='complete'){ //取得XMLHttpRequest物件的狀態值,4--動作完成
	if (xmlHttp.status == 200)
	{ //執行狀態：200：OK 、403：Forbidden 、404：Not Found.......
		var str = xmlHttp.responseText; //接收以文字方式傳回的執行結果
		if (str=='1')
			document.getElementById('msg1').innerHTML = '此帳號已存在!';
		else
			document.getElementById('msg1').innerHTML = '';
	}else
		{
			alert('執行錯誤,代碼:'+xmlHttp.status+'\('+xmlHttp.statusText+'\)');
		}
	} 

}


</script>
@stop