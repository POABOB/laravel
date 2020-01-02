<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\User;
use App\Http\Model\Goods;
class HomeController extends Controller
{
	public function index(Request $request)
	{
		// $pdo = DB::connection()->getPdo();
		// dd($pdo);
		$data = $request->session()->all();
		// var_dump($data);

		// echo date("h:i:s", strtotime('+10 minutes')) ;
		// if((date("h:i:s", strtotime('+10 minutes'))) <= date("h:i:s"))
		// {
		// 	echo 1;
		// }
		$goods = Goods::paginate(8);
        // var_dump($goods);
		return view('index')->with($data)->with('goods', $goods);
	}
	public function login()
	{
		// $name = 'Bob';
		// $age = 20;
		// //利用with傳送資料到模板
		// return view('login')->with('name', $name)->with('age', $age);

		$data = [
			'name' => 'Bob',
			'age' => 20
		];
		$string = '我是字串我驕傲!';
		return view('login', compact('data', 'string'));
	}
}
