<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\UserContent;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgot(Request $request){
        $data = $request->session()->all();
        if(isset($data['member']))
        {
            return redirect('/');
        }

        return view('forgot');
    }

    public function password(Request $request){
        $rules = [
            'email'  => 'required|max:255|email',
         ];
        $messages = [
            'required' => '此欄位必填',
            'max'      => '此欄位最大長度必須小於 :max',
            'email'    => '請填上正確的Email格式!'
        ];
        $validation = $request->validate($rules,$messages);
        $user = UserContent::where('email', $request->email)->first();

        if(!isset($user))
        {
            return redirect()->back()->with('err', '沒有這個使用者!')->withInput();
        }
        //如果不是，那就是重設而已，但還是要寄送驗證信
        $code = $this->generate_code();
        $request->session()->put('code_forgot', $code);
        $request->session()->put('email_forgot', $user->email);
        $request->session()->put('time_forgot', date("h:i:s"));
        $this->sendEmail($user, $code);
        return redirect()->back()->with('msg','請在10分鐘內進行驗證!')->withInput();
    }

    public function sendEmail($user, $code){
        Mail::send(
            //郵寄視圖名稱
            'email.forgot',
            //傳遞的參數，可以讓視圖獲取參數
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("您好!".$user->name."請重設您的密碼!");
            }
        );
    }

    public function generate_code(){
        
        $codeStr = '1234567890abcdefghijklmnopqrstuvwxyzQAZWSXEDCRFVTGBYHNUJMIKOLP';
        $codeLen = 126;        
        $code = '';
        //跑captcha的長度次數
        for($i = 0; $i < $codeLen; $i++){
            //從0~該長度的最後一個
            $code .= $codeStr[mt_rand(0, strLen($codeStr) - 1)];
        }
        return $code;
    }

    public function active(Request $request, $email, $code){
        $data = $request->session()->all();
        if($data['time_forgot'] <= date("h:i:s")+ strtotime('+10 minutes'))
        {
            if($data['code_forgot'] == $code && $data['email_forgot'] == $email)
            {
                $request->session()->forget('code_forgot');
                // $request->session()->forget('email_forgot');
                $request->session()->forget('time_forgot');

                $request->session()->put('active', 1);
                $request->session()->put('time_active', date("h:i:s"));
                return redirect('/reset_password');
            }
            else
            {
                $request->session()->forget('code_forgot');
                $request->session()->forget('email_forgot');
                $request->session()->forget('time_forgot');
                return redirect('/');
            }
        }
        else
        {
            $request->session()->forget('code_forgot');
            $request->session()->forget('email_forgot');
            $request->session()->forget('time_forgot');
            $data = [
                'msg' => '這個驗證已經過期!',
                'url' => url('/'),
                'time' => 3,
            ];
            return view('pageJump')->with($data);
        }
    }
}
