<!DOCTYPE html>
<html>
<head>
	<title>商品編輯</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

</head>

<body>
	<div class="container">
		<form  name='form1' method='POST' action="{{ url('/admin/goods/edit') }}/{{ $data['id'] }}" enctype="multipart/form-data">
		  {{csrf_field()}}
		  <div class="form-group">
		    <label for="good_name">商品名稱</label>
		    <input type='text' name='good_name' size='20' class="form-control" id="good_name" aria-describedby="good_name_Help" placeholder="請輸入商品名稱..." value="{{ $data['good_name'] }}">
		    <small id="good_name_Help" class="form-text text-muted">請輸入20字內商品名稱</small>
		  </div>
		  <div class="form-group">
			  <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">分類名稱</label>
			      <select name="category" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
			        <option value="6" selected>其他</option>
			        <option value="1">衣服</option>
			        <option value="2">3C</option>
			        <option value="3">書籍</option>
			        <option value="4">生活、服務</option>
			        <option value="5">運動用品</option>
			      </select>
		  </div>
		  <div class="form-group">
		    <label for="numbers">數量</label>
		    <input class="form-control" id="numbers" placeholder="請輸入數量..." type='text' name='numbers' size='10' value="{{ $data['numbers'] }}">
		  </div>
		  <div class="form-group">
		    <label for="price">售價</label>
		    <input  type='text' name='price' size='10' class="form-control" id="price" placeholder="請輸入售價..." value="{{ $data['price'] }}">
		  </div>
		  <div class="form-group">
		    <label for="description">商品描述</label>
		    <textarea class="form-control" id="summary-ckeditor" name="description" placeholder="請簡述您的商品特徵、外觀、折舊程度...等">{{ $data['description'] }}</textarea>
		  </div>
		  <div class="form-group">
			<div class="custom-file">
				<label for="image-old">舊圖片</label><br>
				<img id="image-old" src="{{asset('/')}}/{{ $data['image'] }}" width="160px" height="140px"><br>
				<label for="image">請選擇新圖片</label><br>
				<input type="file" name="image" id="image" />
				<small id="image_Help" class="form-text text-muted">如果沒有選擇圖片，則會沿用之前的舊圖片</small>
			  </div>
			</div>
		  <div class="form-group">
		    <label for="how_old">新舊程度</label>
		    <input  type='text' name='how_old' size='10' placeholder="輸入數字1~10" class="form-control" id="how_old" value="{{ $data['how_old'] }}">
		  </div>
		  <input type="submit" class="btn btn-primary" value="送出">
		  <input type="reset" class="btn btn-primary" onclick="javascript:location.href='{{url('/admin/goods')}}'" value="返回">
		</form>

	</div>
</body>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>
</html>


