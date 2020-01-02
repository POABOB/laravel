<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Model\Goods;

class GoodsController extends CommonController
{
    public function addgoods(Request $request){
    	return view('admin.addgoods');
    }

    public function editgoods(Request $request, $good_id){
    	$data = Goods::findOrFail($good_id);
    	$user_id = $request->session()->get('member_id');

    	//如果不符合就403送他
    	if($data->user_id != $user_id){
    		abort("403","你沒有這個操作的權限");
    	}
    	return view('admin.editgoods')->with('data',$data);
    }

    public function store(Request $request){
    	//初始化Model，member_id
    	$goods = new Goods();
    	$user_id = $request->session()->get('member_id');
        $file_path = "storage/app/public/goods/";

    	//先存進資料表
    	$goods->good_name = $request->input('good_name');
    	$goods->category_id = $request->input('category');
    	$goods->numbers = $request->input('numbers');
    	$goods->price = $request->input('price');
    	$goods->description = $request->input('description');
    	$goods->how_old = $request->input('how_old');
    	$goods->user_id = $user_id;

    	//後上傳
    	if($request->hasfile('image'))
    	{
    		$file = $request->file('image');
    		$extension = $file->getClientOriginalExtension();
    		$filename = time().'.'.$extension;
    		$file->move($file_path, $filename);
    		$goods->image = $file_path.$filename;
    	}else
    	{
    		return $request;
    		$goods->image = '';
    	}

    	$goods->save();

    	return redirect('admin/goods')->with('msg', '商品新增成功!');
    }

    public function edit(Request $request, $good_id)
    {
    	//找商品id
    	$goods = Goods::findOrFail($good_id);
    	//確認現在user_id
    	$user_id = $request->session()->get('member_id');

    	//先存進資料表
    	$goods->good_name = $request->input('good_name');
    	$goods->category_id = $request->input('category');
    	$goods->numbers = $request->input('numbers');
    	$goods->price = $request->input('price');
    	$goods->description = $request->input('description');
    	$goods->how_old = $request->input('how_old');
    	$goods->user_id = $user_id;

    	//如果有就更新，並刪除舊檔
    	if($request->hasfile('image'))
    	{
    		$file_path = "storage/app/public/goods/";
	    	$image = $goods->image;

	    	//刪除路徑檔案
	    	unlink($image);


    		//上傳且更新
    		$file = $request->file('image');
    		$extension = $file->getClientOriginalExtension();
    		$filename = time().'.'.$extension;
    		$file->move($file_path, $filename);
    		$goods->image = $file_path.$filename;
    	}else
    	{
    		// return $request;
    		// $goods->image = '';
    	}

    	$goods->save();

    	return redirect('admin/goods')->with('msg', '商品更新成功!');


    }

    public function delete(Request $request, $good_id)
    {
    	//找商品id
    	$goods = Goods::findOrFail($good_id);
    	//確認現在user_id
    	$user_id = $request->session()->get('member_id');

    	//如果不符合就403送他
    	if($goods->user_id != $user_id){
    		abort("403","你沒有這個操作的權限");
    	}

    	
    	$image = $goods->image;

    	//刪除路徑檔案
    	unlink($image);
    	//刪除該筆資料
    	$goods->delete();


    	return redirect()->back()->with('msg2','刪除商品成功!');

    }
//----------------------------------------------------------------------------------
    /*
     *商品屬性ajax
     *
     *
*/
    public function ajax4search(){
        $name = Input::get('name');

    }


    public function list_goods_html() {

        //權限控管
        if ($this->member_model->check_level() !== 0) {
            redirect('home');
        } else {

            $goods_name = $this->input->get('goods_name');
            $goods = $this->goods_model->get_goods_name($goods_name);

            //var_dump($brand);
            $html = '';
            $img = base_url('uploads/');
            $url_e = site_url('goods/edit');
            $url_d = site_url('goods/delete');
            $url_s = site_url('goods/show');
            $url_h = site_url('goods/hidden');
            foreach ($goods as $v) {
                $html .= "<tr>";
                $html .= "<td>".$v['goods_id']."</td>";
                $html .= "<td>".$v['good_sn']."</td>";
                $html .= "<td>".$v['goods_name']."</td>";
                $html .= "<td>".$v['cat_id']."</td>";
                $html .= "<td>".$v['brand_id']."</td>";
                $html .= "<td>".$v['goods_price']."</td>";
                $html .= "<td><img src='".$img.$v['goods_img']."' height='150' width='150'></td>";
                $html .= "<td>".$v['goods_number']."</td>";
                if ($v['is_hot'] == 1)
                {
                    $html .= "<td><a href='".site_url('goods/hot_hidden') . "/" . $v['goods_id']."'>是</a></td>";
                }
                else
                {
                    $html .= "<td><a href='".site_url('goods/hot_show') . "/" . $v['goods_id']."'>否</a></td>";
                }
                if ($v['is_new'] == 1)
                {
                    $html .= "<td><a href='".site_url('goods/new_hidden') . "/" . $v['goods_id']."'>是</a></td>";
                }
                else
                {
                    $html .= "<td><a href='".site_url('goods/new_show') . "/" . $v['goods_id']."'>否</a></td>";
                }
                if ($v['is_best'] == 1)
                {
                    $html .= "<td><a href='".site_url('goods/best_hidden') . "/" . $v['goods_id']."'>是</a></td>";
                }
                else
                {
                    $html .= "<td><a href='".site_url('goods/best_show') . "/" . $v['goods_id']."'>否</a></td>";
                }
                if ($v['is_onsale'] == 1)
                {
                    $html .= "<td>是</td>";
                }
                else
                {
                    $html .= "<td>否</td>";
                }                       
                $html .= "<td>".$v['click_count']."</td>";
                $html .= "<td>";
                if($v['is_onsale'] == 1)
                {
                    $html .= "<a href='".$url_h."/".$v['goods_id']."'>下架</a><br>—<br>";
                }
                else
                {
                    $html .= "<a href='".$url_s."/".$v['goods_id']."'>上架</a><br>—<br>";
                }
                $html .= "<a href='".$url_e."/".$v['goods_id']."'>編輯</a><br>—<br>";
                $html .= "";
                $html .= "<a href='".$url_d."/".$v['goods_id']."'>刪除</a>";
                $html .= "<br></td>";
                $html .= "</tr>";
            }
            echo $html;
        }
    }
}
