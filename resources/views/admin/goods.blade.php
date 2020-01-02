@extends('admin._base')
@section('title', '彰師大二手書交易平台-商品管理介面')
@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@stop
@section('style')
<style>
	.container.custom-container-width {
	    max-width: 940px;
	}
	hr{
		width: 980px;
	}
	.alert .alert-success{
		width: 980px;
	}
	nav a:hover{
		display: block;
		color: #9895a0;
		text-decoration: none;
		padding: 15px 30px;
		font-weight: 500;
		transition: all 0.25s ease-in-out;
	}
	.row{
		max-width: 400px
	}
	/*@media (min-width: 1200px) {
	    .container .custom-container-width{
	        max-width: 940px;
	    }
	    .custom-row-width{
	        max-width: 940px;
	    }
	    .button{
	    	max-width: 940px;
	    }

	}*/
	.page{
		display: flex;
		align-items: center;
		justify-content: center;
		padding-left: 7%;
	}


</style>
@stop
@section('nav')

<nav>
	<a href="{{url('/admin/')}}"><span><i class="fa fa-home"></i></span> 首頁</a>
	<a href="{{url('/admin/order')}}"><span><i class="fa fa-sticky-note"></i></span> 訂單管理</a>
	<a href="{{url('/admin/goods')}}"  class="active"><span><i class="fa fa-bookmark"></i></span> 商品管理</a>
	<a href="{{url('/admin/shipping')}} "><span><i class="fa fa-calendar-check"></i></span> 出貨日期</a>
	<a href="{{url('/admin/buyers')}}"><span><i class="fa fa-user-circle"></i></span> 買家管理</a>
	<a href="{{url('/admin/setting')}}"><span><i class="fa fa-cog"></i></span> 設定</a>
</nav>
@stop

@section('search')
<input class="searchGoods" type="text">
@stop

@section('container')
	<div class="container custom-container-width">
		@if(session('msg'))
		<div class="alert alert-success" role="alert">
		  {{ session('msg') }}
		</div>
		@endif
		@if(session('msg2'))
		<div class="alert alert-success" role="alert">
		  {{ session('msg2') }}
		</div>
		@endif
		<div class="clearfix button">
			<a href="{{ url('/admin/addgoods') }}" class="btn btn-secondary btn-lg">新增商品</a>
		</div>
		<hr>
		<div class="row  custom-row-width">
			<div class="col-sm-4 col-md-11 ">
				@if(count($goods))
				<div class="table">
					<table>
						<thead>
							<tr >
								<th>
									名稱
								</th>
								<th>
									照片
								</th>
								<th>
									分類
								</th>
								<th>
									商品編號
								</th>
								<th>
									數量
								</th>
								<th>
									價格
								</th>
								<th>
									描述
								</th>
								<th>
									新舊
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody id="goodsTable">
							@foreach($goods as $good)
							<tr>
								<td   style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width: 140px;min-width: 140px;">{{ $good->good_name }}</td>
								<td><img style="max-width: 300px; min-width: 300px;" src="{{ asset('/') }}/{{ $good->image }}"></td>
								<td style="word-wrap: break-word; word-break: normal;max-width: 50px;">
									@if($good->category_id==1)
										衣服
									@elseif($good->category_id==2)
										3C
									@elseif($good->category_id==3)
										書籍
									@elseif($good->category_id==4)
										生活、服務
									@elseif($good->category_id==5)
										運動用品
									@elseif($good->category_id==6)
										其他
									@endif
								</td>
								<td style="word-wrap: break-word; word-break: normal;max-width: 30px;">{{ $good->id }}</td>
								<td style="word-wrap: break-word; word-break: normal;max-width: 30px;">{{ $good->numbers }}</td>
								<td style="word-wrap: break-word; word-break: normal;max-width: 30px;">{{ $good->price }}</td>
								<td  style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;min-width: 280px;max-width: 280px;">
											{{ $good->description }}
								</td>
								<td style="word-wrap: break-word; word-break: normal;max-width: 50px;">{{ $good->how_old }}成新</td>
								<td><a href="{{ url('/admin/goods/edit/') }}/{{ $good->id }}"  class="btn btn-secondary">編輯</a>
									<a href="#" class="btn btn-danger" onclick="deleteData({{ $good->id }});">刪除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
					你尚未新增商品!
				@endif
			</div>
		</div>
		<div class="page">
			{!! $goods->links() !!}
		</div>
	</div>	



	
@stop
@section('script')
<script>
	function deleteData(id){
		if(confirm("你確定要刪除這項商品?")){
			window.location.href="{{ url('/admin/goods/delete/') }}"+'/'+id;
			return true;
		}

	}
	$('.searchGoods').keyup(function(){
        //alert($('#brand_name').val());
        var url = {{ url('/admin/goodsSearch/') }};
        //alert(url);
        $.get(url,{name:$('#name').val()},function(data){
        	$('#goodsTable').html(data);

        });
      });

</script>
@stop