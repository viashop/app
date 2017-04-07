<?php

namespace Vialoja\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next(array)
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()->admin) {
            return $next($request);
        } else {
            return redirect()->back();
        }

    }
}
