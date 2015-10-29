<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if(count($roles) > 0) {
            foreach($roles as $r) {
                if ('admin' == strtolower($r)) {
                    $r = 'Administrator';
                }
                if (in_array($r, $user->groups())) {
                    return $next($request);
                }
            }
        }

        return redirect("/profile");
    }
}
