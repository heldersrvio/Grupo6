<?php

namespace equipac\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'usuario':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('usuario');
                }
                break;
            case 'bolsista':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('bolsista');
                }
                break;
            case 'supervisor':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('supervisor');
                }
                break;
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
