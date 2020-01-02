<!DOCTYPE html>
<html>
<head>
	<title>商品新增</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<form  name='form1' method='POST' action="{{ url('/admin/addgoods') }}" enctype="multipart/form-data">
		  {{csrf_field()}}
		  <div class="form-group">
		    <label for="good_name">商品名稱</label>
		    <input type='text' name='good_name' size='20' class="form-control" id="good_name" aria-describedby="good_name_Help" placeholder="請輸入商品名稱..." value="{{ old('good_name') }}">
		    <small id="good_name_Help" class="form-text text-muted">請輸入20字內商品名稱</small>
		  </div>
		  <div class="form-group">
			  <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
			      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
			        <option selected>分類名稱</option>
			        <option value="1">One</option>
			        <option value="2">Two</option>
			        <option value="3">Three</option>
			      </select>
		  </div>
		  <div class="form-group">
		    <label for="numbers">數量</label>
		    <input class="form-control" id="numbers" placeholder="請輸入數量..." type='text' name='numbers' size='10' value="{{ old('numbers') }}">
		  </div>
		  <div class="form-group">
		    <label for="price">售價</label>
		    <input  type='text' name='price' size='10' class="form-control" id="price" placeholder="請輸入售價..." value="{{ old('price') }}">
		  </div>
		  <div class="form-group">
		    <label for="description">商品描述</label>
		    <textarea class="form-control" id="description" rows="3" name='description' placeholder="請簡述您的商品特徵、外觀、折舊程度...等" value="{{ old('description') }}"></textarea>
		  </div>
		  <div class="form-group">
			<div class="custom-file">
				<label for="image">請選擇圖片</label><br>
				<input type="file" name="image" id="image" value="{{ old('image') }}" />
			  </div>
			</div>
		  <div class="form-group">
		    <label for="how_old">新舊程度</label>
		    <input  type='text' name='how_old' size='10' placeholder="輸入數字1~10" class="form-control" id="how_old" value="{{ old('how_old') }}">
		  </div>
		  <input type="submit" class="btn btn-primary" value="送出">
		  <input type="reset" class="btn btn-primary" onclick="javascript:location.href='{{url('/admin/goods')}}'" value="返回">
		</form>

	</div>
</body>
</html>


