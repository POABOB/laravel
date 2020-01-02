<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class adminLogin
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
        $data = $request->session()->all();
        //如果不是admin，那就回login
        if(!isset($data['name']) || !isset($data['member_id']) || $data['right'] != 0xFF)
        {
            return redirect('/login');
        }

        //通往admin介面
        return $next($request);
    }
}
