@extends('admin._base')
@section('title', '彰師大二手書交易平台-賣家設定介面')
@section('nav')
<nav>
	<a href="{{url('/admin/')}}"><span><i class="fa fa-home"></i></span> 首頁</a>
	<a href="{{url('/admin/order')}}"><span><i class="fa fa-sticky-note"></i></span> 訂單管理</a>
	<a href="{{url('/admin/goods')}}"><span><i class="fa fa-bookmark"></i></span> 商品管理</a>
	<a href="{{url('/admin/shipping')}} "><span><i class="fa fa-calendar-check"></i></span> 出貨日期</a>
	<a href="{{url('/admin/buyers')}}"><span><i class="fa fa-user-circle"></i></span> 買家管理</a>
	<a href="{{url('/admin/setting')}}"   class="active"><span><i class="fa fa-cog"></i></span> 設定</a>
</nav>
@stop
@section('container')


安安
@stop