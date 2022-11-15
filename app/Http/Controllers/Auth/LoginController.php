<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\ValidationException;


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

    public function login(Request $request)
    {

        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

        return $this->sendLockoutResponse($request);
    }

    $check = User::where('email',$request->email)->first();

    if(isset($check) && $check->status == 1)
    {

    }else{
        return $this->sendFailedLoginResponseStatus($request);
    }
    

    if ($this->attemptLogin($request)) {
        return $this->sendLoginResponse($request);
    }


    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponseStatus(Request $request)
    {
     throw ValidationException::withMessages([
        $this->username() => ['User is Inactive. Please contact admin.'],
    ]);
    }
}
