<?php

namespace App\Http\Middleware;

use Closure;


class RoleMember
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
        if ($request->user() && $request->user()->role != 'user') {
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
