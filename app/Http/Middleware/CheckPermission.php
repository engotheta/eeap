<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset($request->route()->getAction()['as'])) {
            if (strpos($request->route()->getAction()['as'], '.') != false){
                if (!auth()->user()->can($request->route()->getAction()['as'])) {
                    abort(403, "You are not permitted to perform this action");
                }
            }
        }
        return $next($request);
    }
}
