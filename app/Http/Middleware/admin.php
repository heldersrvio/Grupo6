<?php

namespace equipac\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->nivel == 0) {
            return $next($request);
        }
        return redirect(‘login’)->with(‘error’, ’You have not admin access’);
    }
}
