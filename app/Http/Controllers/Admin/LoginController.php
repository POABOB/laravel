<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;

require_once 'resources/org/captcha/Captcha.class.php';

class LoginController extends CommonController
{
	private $salt1 = '!@#$%';
	private $salt2 = '^&*()';

	public function index(Request $request)
	{
		$data = $request->session()->all();
		if(isset($data['member'])){
			if($data['right'] == 0xFF)
			{
				return redirect('/admin');
			}
			else if($data['right'] == 0x01)
			{
				return redirect('/');
			}
		}
		else{
			$captcha = new \Captcha;
			$_captcha = $captcha->get();

			if($input = Input::all()){
				if(strtoupper($input['captcha']) != $_captcha){
					return back()->with('msg', '驗證碼錯誤!!!');
				}

				$user = Seller::first();
				if(($user->email != $input['email']) || Crypt::decrypt($user->password) != ($this->salt1.$input['password'].$this->salt2)){
					return back()->with('msg', 'Email或密碼錯誤!!!');
				}
				else{
					$request->session()->put('member', $user->email);
					$request->session()->put('member_id', $user->id);
					$request->session()->put('right', $user->right);
					return redirect('/admin/')->with('msg', '登入成功!');
				}
			}
			else{
				return view('admin.login');
			}
		}
	}


	public function captcha()
	{
		$captcha = new \Captcha;
		$captcha->make();
	}

	//取得SESSION驗證碼
	public function getcode()
	{
		$captcha = new \Captcha;
		echo $captcha->get();
	}

	public function logout(Request $request){
		$data = $request->session()->all();
		$request->session()->forget('member_id');
		$request->session()->forget('student_id');
        $request->session()->forget('email');
        $request->session()->forget('name');
        $request->session()->forget('cellphone');
        $request->session()->forget('right');
        $request->session()->forget('avatar');
		return redirect('/');
	}

	
	//加密加鹽
	private function crypto(){
		$salt1 = '!@#$%';
		$salt2 = '^&*()';
		$password = $salt1.'Aa@11235813'.$salt2;
		echo Crypt::encrypt($password);
		echo '<br>';
		echo Crypt::decrypt('eyJpdiI6InpweDJ6WFdSU0xIeTZcLzBqV04xTHdBPT0iLCJ2YWx1ZSI6IlwvVjc1UFpTRnM3WFNBcU1DS2o5WjdJRnBheWZqbWpjM1JJWXJOcTc3NEpzPSIsIm1hYyI6ImM3YmYzZWVlMmNlNTNjNTRjNTdmMTAwYjJmNjYyM2FkNDcxOWNjMzAxNGMwNTY3ZGU1NzhiMDgzNWZhOWJkNDcifQ==');
	}


}
