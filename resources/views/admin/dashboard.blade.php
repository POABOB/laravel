@extends('admin._base')
@section('title', '彰師大二手交易平台-後臺管理介面')

@section('style')
<style >
	a{
		text-decoration: none;
		color: #9895B4;
	}
	a:hover{
		color: black;
	}
</style>
@stop
@section('nav')
<nav>
	<a href="{{url('/admin/')}}" class="active"><span><i class="fa fa-home" ></i></span> 首頁</a>
	<a href="{{url('/admin/order')}}"><span><i class="fa fa-sticky-note"></i></span> 訂單管理</a>
	<a href="{{url('/admin/goods')}}"><span><i class="fa fa-bookmark"></i></span> 商品管理</a>
	<a href="{{url('/admin/shipping')}}"><span><i class="fa fa-calendar-check"></i></span> 出貨日期</a>
	<a href="{{url('/admin/buyers')}}"><span><i class="fa fa-user-circle"></i></span> 買家管理</a>
	<a href="{{url('/admin/setting')}}"><span><i class="fa fa-cog"></i></span> 設定</a>
</nav>
@stop
@section('search')
<input class="searchDashboard" type="text">
@stop

@section('container')
	<div class="container custom-container-width">
		<div class="head">
			<h1>Dashboard</h1>
			<p>歡迎來到彰師二手交易平台</p>
		</div>
		<div class="cards">
			<div class="col-md-4">
				<div class="card">
					<div style="display: flex; align-items: center;">
						<img src="{{ $data['avatar'] }}" class="img" alt="">
					</div>
					
					<span class="user-name">{{ $data['name'] }}</span>
					<span class="user-title">彰化師範大學</span>
					<hr>
					<div class="info">
						<div class="col-md-6">
							<span class="stitle">學號</span>
							<span class="ctitle">手機號碼</span>
						</div>
						<div class="col-md-6">
							<span class="s-id">
							@if($data['student_id'])
								{{ $data['student_id'] }}
							@else
								null
							@endif
							</span>
							<span class="cellphone">
							@if($data['cellphone'])
								{{ $data['cellphone'] }}
							@else
								null
							@endif
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<h4>近期的訂單</h4>
					<span class="date">{{ date("Y-m-d") }}</span>
					@if(count($orders))
					<div class="orderinfo">
						<div class="col-md-9">
							@foreach($orders as $order)
							<span class="ordertime">
								{{ $order->created_at }}
							</span>
							@endforeach
						</div>
						<div class="col-md-3">
							@foreach($orders as $order)
							<span class="order">
								<a href="{{ url('/order/orderdetail') }}/{{ $order->id }}">
								{{ $order->id }}
								</a>
							</span>
							@endforeach
						</div>
					</div>
					@else
						<span style="display: flex;align-items: center;justify-content: center;">目前沒有訂單!</span>
					@endif
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<h3>本月銷售額</h3>
					<div class="moneyinfo">
						<div class="col-md-3">
							<i class="fas fa-dollar-sign"></i>
						</div>
						<div class="col-md-9">
							<div class="money">
							@if($cash>0)
								{{ $cash }}
							@else
								0
							@endif
							</div>
						</div>
						<hr>	
					</div>
				</div>
			</div>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<th>
							COMPANY
						</th>
						<th>
							JOBS
						</th>
						<th>
							END OF APPLICATION
						</th>
						<th>
							LOCATION
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>ONLINE SHOPPING</td>
						<td>PYTHON DEVELOPER</td>
						<td>2 Mar, 2019</td>
						<td>Taichung, Taiwan</td>
					</tr>
					<tr>
						<td>ONLINE SHOPPING</td>
						<td>PYTHON DEVELOPER</td>
						<td>2 Mar, 2019</td>
						<td>Taichung, Taiwan</td>
					</tr>
					<tr>
						<td>ONLINE SHOPPING</td>
						<td>PYTHON DEVELOPER</td>
						<td>2 Mar, 2019</td>
						<td>Taichung, Taiwan</td>
					</tr>
					<tr>
						<td>ONLINE SHOPPING</td>
						<td>PYTHON DEVELOPER</td>
						<td>2 Mar, 2019</td>
						<td>Taichung, Taiwan</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@stop