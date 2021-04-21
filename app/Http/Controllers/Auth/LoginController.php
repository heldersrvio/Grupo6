<?php

namespace equipac\Http\Controllers\Auth;

use equipac\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:usuario')->except('logout');
        $this->middleware('guest:bolsista')->except('logout');
        $this->middleware('guest:supervisor')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('usuario')->check()) {
            Auth::guard('usuario')->logout();
            return redirect('/usuario/login');
        } else if (Auth::guard('bolsista')->check()) {
            Auth::guard('bolsista')->logout();
            return redirect('/bolsista/login');
        } else if (Auth::guard('supervisor')->check()) {
            Auth::guard('supervisor')->logout();
            return redirect('/supervisor/login');
        } else if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        }
    }
}
