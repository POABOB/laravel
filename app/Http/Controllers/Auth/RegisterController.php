<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use App\Http\Model\UserContent;
require_once 'resources/org/captcha/Captcha.class.php';
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    private $salt1 = '!@#$%';
    private $salt2 = '^&*()';
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

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
                    'username' => 'required|max:255',
                    'email'  => 'required|max:255|email',
                    'password' => 'required|max:255',
                    'passconf' => 'required|same:password',
                    'captcha' => 'required|max:5',
                 ];
                $messages = [
                    'required' => '請填入欄位!',
                    'max'      => '最大長度必須小於 :max',
                    'email'    => '請填上正確的Email格式!',
                    'passconf.same'     => '兩組密碼請相同!',
                ];
                $validation = $request->validate($rules,$messages);
                if(strtoupper($input['captcha']) != $_captcha){
                    return back()->with('msg1', '驗證碼錯誤!!!')->withInput();
                }

                $user = UserContent::where('email', $input['email'])->first();
                
                if(isset($user->email))
                {
                    return back()->with('msg1', 'email已經被使用過囉!')->withInput();
                }
                else
                {
                    $password = $this->salt1.$request->password.$this->salt2;
                    $password = Crypt::encrypt($password);
                    $user = UserContent::where('email', $email)->update(['password' => $password]);
                    UserContent::create([
                        'name' => $input['username'],
                        'email' => $input['email'],
                        'password' => Crypt::encrypt($this->salt1.$input['email'].$this->salt2),
                        'right' => 0x01
                    ]);
                    $user = UserContent::where('email', $input['email'])->first();
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

    public function checkEmail($email)
    {
        $user = UserContent::where('email', $email)->first();
        if(isset($user))
            return 1;
        return 0;
    }
}
