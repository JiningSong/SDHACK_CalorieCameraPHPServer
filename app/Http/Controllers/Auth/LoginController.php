<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'string',
            'email' => 'string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        if($request->only('route')!=null){
            $this->redirectTo = "/".$request->input('route');
        }

        if($request->only('email')!=null){
            session(['type'=>'email']);
            return $request->only('email', 'password');
        }
        else {
            session(['type'=>'mobile']);
            return $request->only('mobile', 'password');
        }
    }
}
