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
        // return response()->json([
        //     'token' => JWT::decode($token, $key, array('HS256'))
        // ]);
        try {
            $decoded = (array) JWT::decode($token, $key, array('HS256'));
            //check expired
            // if($decoded['exp'] < time()) {
            //     return response()->json([
            //         'type' => 'expired'
            //     ]);
            // }
            //check role
            //...
            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
