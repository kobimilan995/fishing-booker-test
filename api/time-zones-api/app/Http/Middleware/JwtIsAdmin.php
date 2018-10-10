<?php

namespace App\Http\Middleware;

use Closure;

class JwtIsAdmin
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
        $user = $request['user'];
        if($user->role_name != 'Admin') {
            return response()->json([
                'message' => 'You don\'t have required permissions!'
            ], 403);
        }
        return $next($request);
    }
}
