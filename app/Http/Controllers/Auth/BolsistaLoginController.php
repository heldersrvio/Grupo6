<?php

namespace equipac\Http\Controllers\auth;

use Illuminate\Http\Request;
use equipac\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class BolsistaLoginController extends Controller
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
        $this->middleware('guest:bolsista')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('bolsista.auth.login');
    }
    public function loginBolsista(Request $request)
    {
      // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
      // Attempt to log the user in
        if (Auth::guard('bolsista')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
            return redirect()->intended(route('bolsista'));
        }
      // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('bolsista')->logout();
        return redirect()->route('login-bolsista');
    }
}
