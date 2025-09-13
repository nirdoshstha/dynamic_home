<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $email): Response
    {
        if(auth()->user()->email ==$email){
            return $next($request);
        }
        else{
            return redirect('/')->with('error_message','You have no access to enter Admin/Dashboard !!');
        }

    }
}
