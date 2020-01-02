<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Model\User;
use App\Http\Model\SocialAccount;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request,$provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        }
        catch(Exception $e){
            return redirect('/login');
        }
        $user_id = $this->findOrCreateUser($user, $provider);

        $user = User::where('id', $user_id)->first();


        $request->session()->put(['member_id' => $user->id,
                                  'student_id' => $user->student_id,
                                  'email' => $user->email,
                                  'name' => $user->name,
                                  'cellphone'=>$user->cellphone,
                                  'right'=>$user->right,
                                  'avatar'=>$user->avatar,
                            ]);



        return redirect('/');
    }


    public function findOrCreateUser($user, $provider)
    {
        $socialAccount = SocialAccount::where('provider_id', $user->getId())
                        ->where('provider_name', $provider)
                        ->first();

        if($socialAccount)
        {
            return $socialAccount->user_id;
        }
        else
        {
            $member = User::where('email', $user->getEmail())->first();

            if(!$member)
            {
                $member = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'avatar' => $user->getAvatar(),
                    'right' => 0x01
                ]);
            }
            $member->socialAccount()->create([
                'provider_id' => $user->getId(),
                'provider_name' => $provider
            ]);
            // echo $member;
            return $member->user_id;
        }
    }


}
