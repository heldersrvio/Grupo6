<?php

namespace equipac\Http\Middleware;

use Closure;

class supervisor
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
    if (auth()->user()->nivel == 1) {
        return $next($request);
    }
    return redirect(‘login’)->with(‘error’, ’You have not admin access’);
}
