<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use Cart;

use App\Http\Model\Carts;
use App\Http\Model\Orders;
use App\Http\Model\OrderItems;

class CartController extends Controller
{
	public function index(Request $request)
    {
    	return view('shoppingcart');
    }

    	//新增至購物車
    public function add(Request $request)
    {


        $add = Cart::add([
                'id' => $request->id,
                'name' => $request->good_name,
                'price' => $request->price,
                'qty' => $request->numbers,
                'options' => ['seller_id' => $request->seller_id,
                              'image' => $request->image,
                            ],
                ]);

    	return redirect()->back();

    }

    public function addAndBuy(Request $request)
    {

        $add = Cart::add([
                'id' => $request->id,
                'name' => $request->good_name,
                'price' => $request->price,
                'qty' => $request->numbers,
                'options' => ['seller_id' => $request->seller_id,
                              'image' => $request->image,
                            ],
                ]);
        return redirect('/cart');
    }

    //增加減少
    public function update4post(Request $request)
    {

    	$update = Cart::update($request->rowId, ['qty' => $request->qty]);
        return redirect()->back();
    }

    //增加減少
    public function update4get(Request $request)
    {

        $update = Cart::update($request->rowId, ['qty' => $request->newQty]);


        

        return 1;

    }

    //刪除
    public function delete(Request $request, $rowId)
    {

        Cart::remove($rowId);

        return redirect()->back();
    	
    }

    //下單
    public function buy(Request $request)
    {
        $user_id = $request->session()->get('member_id');

        foreach(Cart::content() as $row){
            $seller_id = $row->options->seller_id;
            break;
        }



        if($user_id == null)
        {
            return redirect('/login');
        }
        //新增到Carts表
        foreach (Cart::content() as $row) {
            $carts = Carts::create([
                            'user_id' => $user_id,
                            'good_id' => $row->id,
                        ]);
        }
        

        $orders = Orders::create([
                            'cash' => Cart::subtotal(0,0,0),
                            'seller_id' => $seller_id,
                            'buyer_id' => $user_id,
                            'status' => 0,
                        ]);


        
      
        // var_dump($orders->order_id);
        // exit();
        foreach (Cart::content() as $row) {
            $orderitems = OrderItems::create([
                            'idOrder' => $orders->id,
                            'user_id' => $user_id,
                            'good_id' => $row->id,
                            'numbers' => $row->qty,
                        ]);
        }

        Cart::destroy();

        return redirect('/');
// DB::table('p_orderitems')
//             ->join('p_goods', 'goods.id', '=', 'p_orderitems.good_id')
//             ->select('p_goods.id','p_goods.image','p_goods.good_name','p_goods.price')
//             ->get();


    }
}
