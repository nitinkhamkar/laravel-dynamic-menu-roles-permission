<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
   // protected $redirectTo = '/home';
    public function redirectTo(){
        
    // User role
    $role = Auth::user()->roles; 
    
    if($role->count())
     return route('dashboard');
    else
         return route('home'); 
    // Check user role
    // switch ($role) {
    //     case 'super-admin':
    //             return route('dashboard');
    //         break;
    //     case 'Employee':
    //             return '/projects';
    //         break; 
    //     default:
    //             return route('home'); 
    //         break;
    // }
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

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
