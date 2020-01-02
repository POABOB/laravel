<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Model\UserContent;
class MemberController extends Controller
{
    public function index(Request $request){
    	$data = $request->session()->all();
    	var_dump($data);
    	// return redirect('member')->with($data);
    }

    public function update_data(Request $request){
    	// protected $fillable = ['student_id', 'password', 'cellphone', 'birthday', 'right', 'avatar', 'update_at'];
    	$input = Input::all();

    	$data = $request->session()->all();
    	$user = UserContent::find($data['member_id']);
    	if(isset($input['student_id']))
		{
			$user->student_id = $input['student_id'];
		}

		if(isset($input['cellphone']))
		{
			$user->cellphone = $input['cellphone'];
		}

		if(isset($input['birthday']))
		{
			$user->birthday = $input['birthday'];
		}

		$user->right = 0x02;
		$user->update_at = date("Y-m-d h:i:s");
		$user->save();
    }

    public function avatar(Request $request){


    }

    public function needUpdate()
    {
    	return ;
    }
}
