<?php

namespace App\Http\Middleware;

use Closure;

use \Firebase\JWT\JWT;

class JwtAuthenticated
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
        $key = env('SECRET_KEY');
        $token = $request->bearerToken();
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            //check expired
            //check role
            //...
            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 402);
        }
    }
}
