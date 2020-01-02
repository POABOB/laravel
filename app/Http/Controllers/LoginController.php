<?php


/*****************************************************
 * 這個控制器主要是實作非社群登入介面、登出和Captcha引入  *
 *****************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\UserContent;


require_once 'resources/org/captcha/Captcha.class.php';

class LoginController extends Controller
{
	private $salt1 = '!@#$%';
	private $salt2 = '^&*()';


/*********************************************************
 * 1. 登入: 一般使用者登入，輸入帳密直接登入，並開啟SESSION，*
 * 社群軟體登入，則是利用Auth\LoginController執行。			 *
 * 2. 登出												 *
 * 3. Captcha 											 *
 *********************************************************/
	public function index(Request $request)
	{
		$data = $request->session()->all();
		if(isset($data['name'])){
			// var_dump($data);
			return redirect('/');
		}
		else
		{
			$captcha = new \Captcha;
			$_captcha = $captcha->get();

			if($input = Input::all())
			{
				$rules = [
		            'email'  => 'required|max:255|email',
		            'password' => 'required|max:255',
		            'captcha' => 'required|max:5',
		         ];
		        $messages = [
		            'required' => '請填入欄位!',
		            'max'      => '最大長度必須小於 :max',
		            'email'    => '請填上正確的Email格式!'
		        ];
        		$validation = $request->validate($rules,$messages);
				if(strtoupper($input['captcha']) != $_captcha){
					return back()->with('msg2', '驗證碼錯誤!!!')->withInput();
				}

				$user = UserContent::where('email', $input['email'])->first();
				
				if(($user->email != $input['email']) || Crypt::decrypt($user->password) != ($this->salt1.$input['password'].$this->salt2)){
					return back()->with('msg2', '帳號或密碼錯誤!')->withInput();
				}
				else
				{
					$request->session()->put(['member_id' => $user->id,
                                  'student_id' => $user->stid,
                                  'email' => $user->email,
                                  'name' => $user->name,
                                  'cellphone'=>$user->cellphone,
                                  'right'=>$user->right,
                                  'avatar'=>$user->avatar,
                            ]);
					return redirect('/');
				}
			}
			else
			{
				return view('login.login');
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
		$request->session()->forget('member_id');
		$request->session()->forget('student_id');
        $request->session()->forget('email');
        $request->session()->forget('name');
        $request->session()->forget('cellphone');
        $request->session()->forget('right');
        $request->session()->forget('avatar');
		return redirect('/');
	}



}

