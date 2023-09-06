<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Session;

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

    Use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $authService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->authService = new AuthService();
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
    
        try {
            // Implement rate limiting - Laravel default
            $this->incrementLoginAttempts($request);

            $response = $this->authService->authenticate($this->credentials($request));

            if ($response) {
                // Implement rate limiting - After successful login
                $this->clearLoginAttempts($request);

                $token = $response->getToken();
                return $this->authenticated($request, $token) ?: redirect()->intended($this->redirectPath());
            } else {
                return $this->sendFailedLoginResponse($request);
            }
        } catch (JWTException $e) {
            return $this->sendFailedLoginResponse($request);
        }
    }

    public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function authenticated(Request $request, $token)
    {
        $response = $this->authService->me($token);

        if ($response) {
            // Set values in the session
            Session::put('Id', $response['hino_id']);
            Session::put('Username', $response['hino']);
            Session::put('Email', $response['hino_email']);
            Session::put('Roles', $response['hino_role']);
            Session::put('Token', $token);
        }
    }

    // Logout and redirect
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();

        return redirect('/login'); //redirect to login
    }
}