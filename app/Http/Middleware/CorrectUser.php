<?php

namespace App\Http\Middleware;

use Closure;

class CorrectUser
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
        if (intval($request->route()->getParameter('user')) !== intval($request->user()->id)) {
            return redirect('/');
        }
        return $next($request);
    }
}
