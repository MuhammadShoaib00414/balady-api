<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $maxLoginAttempts = 5; // Amount of bad attempts user can make

    protected $decayMinutes = 60; // Default is 1

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    protected function redirectTo()
    {
        if(Auth::user()->roles[0]['name']=='SuperAdmin'){
            return route('admin.index');
        }elseif(Auth::user()->roles[0]['name']=='Admin'){
            return route('admin.index');
        }elseif(Auth::user()->roles[0]['name']=='Student'){
            return route('student.index');
        }elseif(Auth::user()->roles[0]['name']=='Trainer'){
            return route('trainer.index');
        }

    }


}
