<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Model\UserContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    private $salt1 = '!@#$%';
    private $salt2 = '^&*()';

    public function index(Request $request)
    {
        $data = $request->session()->all();
        if(!(isset($data['active'])))
        {
            return redirect('');
        }

        if($data['active'] == 1 && ($data['time_active'] <= date("h:i:s") + strtotime('+10 minutes')))
        {
            return view('reset_password');
        }
        else
        {
            $request->session()->forget('active');
            $request->session()->forget('time_active');
            $data = [
                'msg' => '這個驗證已經過期!',
                'url' => url('/'),
                'time' => 3,
            ];
            return view('pageJump')->with($data);
        }
    }

    public function reset(Request $request){
        $rules = [
            'password' => 'required|max:255',
            'passconf' => 'required|same:password',
         ];
        $messages = [
            'required' => '此欄位必填',
            'max'      => '此欄位最大長度必須小於 :max',
            'same'    => '兩組密碼要相同喔!'
        ];
        $validation = $request->validate($rules,$messages);
        $email = $request->session()->get('email_forgot');
        $password = $this->salt1.$request->password.$this->salt2;
        $password = Crypt::encrypt($password);
        $user = UserContent::where('email', $email)->update(['password' => $password]);
        $request->session()->forget('active');
        $request->session()->forget('time_active');
        $request->session()->forget('email_forgot');
        return redirect('/login');
    }

    public function reset_password()
    {
        
    }
}
