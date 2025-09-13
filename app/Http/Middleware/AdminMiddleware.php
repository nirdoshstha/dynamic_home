<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

            if(auth()->user()->user_role =='1' || auth()->user()->user_role=='2'){

                if(auth()->check() && auth()->user()->is_banned){
                    $banned = auth()->user()->is_banned == '1';
                    auth()->logout();

                    if($banned ==1){
                       $message ='Your Account has been banned, pls contact Administrtor';
                    }
                    return redirect()->route('login')
                    ->with('status',$message)
                    ->withErrors(['email' =>'Your Account has been banned, pls contact Adminstrator !!']);
               }
                return $next($request);
            }
            else{
                return redirect('/home')->with('status','You have no access to Enter Admin/Dashboard');
            }



    }
}
