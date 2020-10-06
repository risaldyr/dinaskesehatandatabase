<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\Response;

class Role
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
        if ($request->user() && $request->user()->role != 'admin') {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
