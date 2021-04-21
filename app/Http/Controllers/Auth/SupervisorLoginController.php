<?php

namespace equipac\Http\Controllers\auth;

use Illuminate\Http\Request;
use equipac\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class SupervisorLoginController extends Controller
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
    public function __construct()
    {
        $this->middleware('guest:supervisor')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('supervisor.auth.login');
    }

    public function loginBolsista(Request $request)
    {
      // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('supervisor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('supervisor'));
        }
        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('supervisor')->logout();
        return redirect()->route('login-supervisor');
    }
}
