<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use App\Http\Model\Orders;
use App\Http\Model\OrderItems;
class HomeController extends CommonController
{
    public function index(Request $request)
    {
        $orders = $orders = Orders::where('status',0)->take(3)->orderBy('created_at','desc')->get();
        $cash = 0;
        $data = $request->session()->all();
    	return view('admin.dashboard')->with('data',$data)->with('orders',$orders)->with('cash', $cash);
    }

    // public function login()
    // {
    // 	return view('admin.login');
    // }
    
    public function order(Request $request)
    {
        $data = $request->session()->all();
        $orders = Orders::paginate(5);
    	return view('admin.order')->with('data',$data)->with('orders', $orders);
    }

    public function goods(Request $request)
    {
        $data = $request->session()->all();
        $goods = Goods::paginate(3);
        // var_dump($goods);
        return view('admin.goods')->with('goods', $goods)->with('data',$data);
    }

    public function buyers()
    {
        return view('admin.buyers');
    }

    public function shipping()
    {
        return view('admin.shipping');
    }

    public function setting()
    {
        return view('admin.setting');
    }
}
