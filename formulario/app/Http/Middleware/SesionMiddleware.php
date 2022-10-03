<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class SesionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
	
    public function handle($request, Closure $next,$signal)
    {
		
		if (isset($_POST['login_user']) ){
			//$us = User::getUser( $_POST['login_user'] , $_POST['login_pass'] ); // , 'password' =>  ] )->get();
			
			$us = User::where( ['email' =>  $_POST['login_user'] , 'password' => $_POST['login_pass'] ] )->get();
			
			
			if ( count( $us ) > 0 ){
				session(['ses_user' => $us[0]->nombre ]);
				session(['ses_mail' => $us[0]->email  ]);
				session(['ses_id' =>   $us[0]->id     ]);

				return $next($request);
			}
			
			
			
		}elseif ( $signal === 'logout' ){
			
			$request->session()->forget('ses_user');
			$request->session()->forget('ses_mail');
			$request->session()->forget('ses_id');

		}elseif ( $request->session()->has('ses_id') ){
			return $next($request);
		}
		
		//return $next($request);
		
        return redirect()->route('startLogin');
    }
}
