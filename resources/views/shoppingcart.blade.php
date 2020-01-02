@extends('login._base')
@section('title', '彰師大二手交易平台-購物車')
@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@stop
@section('style')
<style>
a:hover{
		text-decoration:none;
		color: black;
	}
.container{
	padding-top: 10%;
}
.table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
		width:20%;
		display: inline !important;
	}
	.actions .btn{
		width:36%;
		margin:1.5em 0;
	}
	
	.actions .btn-info{
		float:left;
	}
	.actions .btn-danger{
		float:right;
	}
	
	table#cart thead { display: none; }
	table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
	table#cart tbody tr td:first-child { background: #333; color: #fff; }
	table#cart tbody td:before {
		content: attr(data-th); font-weight: bold;
		display: inline-block; width: 8rem;
	}
	
	
	
	table#cart tfoot td{display:block; }
	table#cart tfoot td .btn{display:block;}
	
	.btn{
		cursor: pointer;
	}
	img {
	    
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
                    <!-- <li class="search">
                    	<form action="{{ url('/search') }}" method="post">
                    		<input type="text" name="search">
                    	</form>
                    </li> -->
                </ul>
            </nav>
        </header>
@stop
@section('container')
<!-- <div class="box"> -->
<div class="container">
	<table id="cart" class="table table-hover table-condensed">
		<div id="t">
    				<thead>
						<tr>
							<th style="width:50%">商品</th>
							<th style="width:10%">價格</th>
							<th style="width:8%">數量</th>
							<th style="width:22%" class="text-center">總計</th>
							<th style="width:10%">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach(Cart::content() as $row)
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img style="margin-top: 0px;" src="{{ asset('/') }}/{{ $row->options->image }}" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<p class="nomargin"><strong>{{ $row->name }}</strong></p>
									</div>
							</td>

							<td data-th="Price">{{ $row->price }}</td>
							<td data-th="Quantity">
								<form action="{{ url('/cart/update/') }}" method="post">
									{{ csrf_field() }}
								<input type="number" id="qty{{ $row->id }}" name="qty" class="form-control text-center" value="{{$row->qty}}">
								<input type="hidden" id="rowId{{ $row->rowId }}" name="rowId" value="{{ $row->rowId }}">
							</td>
							<td data-th="Subtotal" class="text-center">${{ $row->subtotal(0) }}</td>
							<td class="actions" data-th="">
								<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
								</form>
								<a href="{{ url('/cart/delete') }}/{{ $row->rowId }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>								
							</td>
						</tr>
     				@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>返回購物</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong>${{ Cart::subtotal(0) }}</strong></td>
							<td><a href="{{ url('/cart/buy') }}" class="btn btn-success btn-block">結帳<i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
					</div>
				</table>
			</div>
		<!-- </div> -->
@stop
@section('script')
<script>

$(document).ready(function(){
	@foreach(Cart::content() as $row)
	$('#qty{{ $row->id }}').on('change keyup', function(){
		var newQty = $('#qty{{ $row->id }}').val();
		var rowId = $('#rowId{{ $row->rowId }}').val();
		
		$.ajax({
			url:'{{ url('/cart/update') }}',
			data:'rowId=' + rowId + '&newQty=' + newQty,
			type:'get',
			success:function(response){
				console.log(response);
				if(response==1){
					window.location.reload();
				}
			}
		});
	});
	@endforeach
});

</script>
@stop