<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class memberLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //如果不是member，那就回 login
        $data = $request->session()->all();
        if(!isset($data['name']) || !isset($data['member_id']) || !isset($data['right']))
        {
            $request->session()->forget('member_id');
            $request->session()->forget('student_id');
            $request->session()->forget('email');
            $request->session()->forget('name');
            $request->session()->forget('cellphone');
            $request->session()->forget('right');
            $request->session()->forget('avatar');
            return redirect('/login');
        }

        return $next($request);
    }
}
