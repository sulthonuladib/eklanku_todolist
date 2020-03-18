<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.loginv1');
    }

    public function login(Request $request)
    {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
    {
        // Updated this line
        return $this->sendLoginResponse($request);

        // OR this one
        // return $this->authenticated($request, auth()->user());
    }
    else
    {
        $gagal = "<script>
            alert('Gagal, Username atau Password Salah !!');
            window.location = '/login';
        </script>";
        // return $this->sendFailedLoginResponse($request, $gagal);
        return $gagal;
    }
    }
}
