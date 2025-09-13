<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(){
        if(auth()->user()->user_role=='1' || auth()->user()->user_role=='2'){
            return 'admin/dashboard';
        }
        if(auth()->user()->user_role=='0'){
            return '/';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     // function for Login from username and email
     public function username(){
        $loginValue = request('username');
        $this->username = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$this->username=>$loginValue]);
        return property_exists($this,'username') ? $this->username : 'email';
    }
}
