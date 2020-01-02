<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __constructor(Request $request)
    {
    	$data = $request->session()->all();
    	if(!(isset($data['email_forgot']) && isset($data['active']) && (date($data['time_forgot'] + strtotime('+10 minutes')) <= date("h:i:s"))))
        {
        	$request->session()->forget('email_forgot');
        	$request->session()->forget('time_forgot');
        	$request->session()->forget('code_forgot');
        }

        if(!($data['active'] && (date($data['time_active'] + strtotime('+10 minutes')) <= date("h:i:s"))))
        {
        	$request->session()->forget('active');
        	$request->session()->forget('time_active');
        }
    }
}
