@extends('login._base')
@section('title', '彰師大二手交易平台-首頁')
@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@stop
@section('style')
<style>

	body{
		background: #f7f4f4;
	}
	.carousel .carousel-item {
	  height: 400px;
	}
	.carousel .carousel-item img {
	  min-height: 400px;
	  max-height: 500px;
	  object-fit: cover;
	}
	.btn{
		width: 44%;
		margin: 0 5px 10px 10px;
	}
	.caption{
		margin: 5px 5px 0 5px;
		height: 50px;
	}
	.price{
		font-weight: bold;
	}
	.caption,  .price, .description{
		display: flex;
		justify-content: center;
	}
	.thumbnail{
		box-shadow: 0px 0px 10px rgba(0,0,0,.5);
	/*	max-height:400px;:
		height: 380px;*/
	}
	.category{
		transition: all 0.8s;
		box-shadow:0px 0px 10px rgba(0,0,0,0);
	}
	.category:hover{

		box-shadow: 0px 0px 10px rgba(0,0,0,.5);
	}
	a{
		color: rgba(0,0,0,.9);
		
	}
	a:hover{
		text-decoration:none;
		color: black;
	}
	li.search{
		padding-top:11px;
		padding-bottom:11px;
	}
</style>
@stop
@section('nav')
        <header>
            <nav>
                <div class="logo-section">
                    <a href="{{ url('/') }}" class="logo">MARKET</a>
                    <button class="hb-button"><i class="fa fa-bars"></i></button>
                </div>
                <ul>
                	@if(!session('member_id'))
                    <li><a href="{{ url('/login') }}">登入</a></li>
                    @else
					<li><a href="{{ url('/member') }}">會員</a></li>
                    @endif
                    <li><a href="{{ url('/cart') }}">購物車({{ Cart::count() }})</a></li>
                    @if(session('right') == 0xFF)
                    <li><a href="{{ url('/admin') }}">後臺管理介面</a></li>
                    @endif
                    <li><a href="{{ url('/') }}">首頁</a></li>
                    <li class="search">
                    	<form action="{{ url('/search') }}" method="post">
                    		<input type="text" name="search">
                    	</form>
                    </li>
                </ul>
            </nav>
        </header>
@stop

	@section('carousel')
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-sm-12">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner" role="listbox">
				    <div class="carousel-item active">
				      <img src="{{ asset('/resources/assets/img/') }}/head.png" class="d-block" alt="">
				    	<div class="carousel-caption">
				    		<h1 style="color: black;">廣告一</h1>
				    	</div>
				    </div>
				    <div class="carousel-item">
				      <img src="{{ asset('/resources/assets/img/') }}/900001.jpg" class="d-block w-100  h-50" alt="">
				    	<div class="carousel-caption">
				    		<h1 style="color: black;">廣告二</h1>
				    	</div>
				    </div>
				    <div class="carousel-item">
				      <img src="{{ asset('/resources/assets/img/') }}/900002.jpg" class="d-block w-100  h-50" alt="">
				    	<div class="carousel-caption">
				    		<h1 style="color: black;">廣告三</h1>
				    	</div>
				    </div>
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>
	</div>
	@stop
	@section('category')
	<div class="container" >
		<div class="row">
			<div class="col-sm-2 col-md-2" style="padding: 0 3px 0 3px;padding-left: 15px;">
				<div class="thumbnail category" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href="{{ url('/goods/clothes') }}"><img src="{{ asset('/resources/assets/img/') }}/3C.png" alt="" style="max-height: 150px; height: 200px; margin-top: 0px;" class="img-responsive"></a>
					<div class="description">
						<a href="{{ url('/goods/clothes') }}"><h5>衣服</h5></a>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-md-2" style="padding: 0 3px 0 3px;">
				<div class="thumbnail category" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href="{{ url('/goods/3C') }}"><img src="{{ asset('/resources/assets/img/') }}/clothes.png" alt="" style="max-height: 150px; height: 200px; margin-top: 0px;" class="img-responsive"></a>
					<div class="description">
						<a href="{{ url('/goods/3C') }}"><h5>3C</h5></a>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-md-2" style="padding: 0 3px 0 3px;">
				<div class="thumbnail category" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href="{{ url('/goods/books') }}"><img src="{{ asset('/resources/assets/img/') }}/books.png" alt="" style="max-height: 150px; height: 200px; margin-top: 0px;" class="img-responsive"></a>
					<div class="description">
						<a href="{{ url('/goods/books') }}"><h5>書籍</h5></a>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-md-2" style="padding: 0 3px 0 3px;">
				<div class="thumbnail category" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href="{{ url('/goods/life') }}"><img src="{{ asset('/resources/assets/img/') }}/life.png" alt="" style="max-height: 150px; height: 200px; margin-top: 0px;" class="img-responsive"></a>
					<div class="description">
						<a href="{{ url('/goods/life') }}"><h5>生活、服務</h5></a>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-md-2" style="padding: 0 3px 0 3px;">
				<div class="thumbnail category" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href="{{ url('/goods/sports') }}"><img src="{{ asset('/resources/assets/img/') }}/sports.png" alt="" style="max-height: 150px; height: 200px; margin-top: 0px;" class="img-responsive"></a>
					<div class="description">
						<a href="{{ url('/goods/sports') }}"><h5>運動用品</h5></a>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-md-2" style="padding: 0 3px 0 3px; padding-right: 12px;">
				<div class="thumbnail category" style="background: #fff; padding: 0 0 10px 0; margin-top: 10px;">
					<a href="{{ url('/goods/others') }}"><img src="{{ asset('/resources/assets/img/') }}/others.png" alt="" style="max-height: 150px; height: 200px; margin-top: 0px;" class="img-responsive"></a>
					<div class="description">
						<a href="{{ url('/goods/others') }}"><h5>其他</h5></a>
					</div>
				</div>
			</div>

		</div>
	</div>

	@stop
	@section('container')
	<div class="container" >
		<div class="row">
			@foreach($goods as $good)
			<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="{{ asset('/') }}/{{ $good->image }}" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>{{ $good->good_name }}</h5></a>
					</div>
					<div class="price">
						<h4>{{ $good->price }}</h4>
					</div>
					<div class="clearfix">
						<form action="{{ url('/cart/addToCarts/') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $good->id }}">
							<input type="hidden" name="good_name" value="{{ $good->good_name }}">
							<input type="hidden" name="price" value="{{ $good->price }}">
							<input type="hidden" name="numbers" value="1">
							<input type="hidden" name="seller_id" value="{{ $good->user_id }}">
							<input type="hidden" name="image" value="{{ $good->image }}">
							<button type="submit" class="btn btn-outline-danger pull-right">直接購買</button>
						</form>
						<form action="{{ url('/cart/addCarts/') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $good->id }}">
							<input type="hidden" name="good_name" value="{{ $good->good_name }}">
							<input type="hidden" name="price" value="{{ $good->price }}">
							<input type="hidden" name="numbers" value="1">
							<input type="hidden" name="seller_id" value="{{ $good->user_id }}">
							<input type="hidden" name="image" value="{{ $good->image }}">
							<button type="submit" class="btn btn-outline-warning pull-left">放入購物車</button>
						</form>
					</div>
					<div>
						
					</div>
				</div>
			</div>
			@endforeach
<!-- 			<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
						<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
						<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
						<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
						<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
						<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
						<div class="col-sm-4 col-md-3">
				<div class="thumbnail" style="background: #fff; padding: 0px 0 10px 0; margin-top: 10px;">
					<a href=""><img src="https://image.cache.storm.mg/styles/smg-800x533-fp/s3/media/image/2018/12/12/20181212-120438_U11420_M482738_83bd.jpg?itok=1u9iZZVo" alt="" style="max-height: 300px; height: 250px; margin-top: 0px;" class="img-responsive"></a>
					<div class="caption">
						<a href=""><h5>小狼狗愛吃狗肉狗肉要輸 肥 我就不愛吃</h5></a>
					</div>
					<div class="price">
						<h4>$ 3,300</h4>
					</div>
					<div class="clearfix">
							<a href="" class="btn btn-outline-danger pull-right">直接購買</a>
							<a href="" class="btn btn-outline-warning pull-left">放入購物車</a>
					</div>
					<div>
						
					</div>
				</div>
			</div>
 -->
 		
		</div>
		<div class="page">
			{!! $goods->links() !!}
		</div>
	</div>
	@stop


	










@section('script')
<script>
	$('.carousel').carousel();
</script>
@stop