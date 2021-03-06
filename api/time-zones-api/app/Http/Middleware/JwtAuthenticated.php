<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

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
            $decoded = (array) JWT::decode($token, $key, array('HS256'));
            $user_id = $decoded['id'];
            $user_data = DB::select("SELECT * FROM users INNER JOIN tokens on users.id = tokens.user_id INNER JOIN roles on users.role_id = roles.role_id WHERE users.id = '{$user_id}'");

            if(!$user_data) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            if($user_data[0]->expire_date < time()) {
                DB::delete("DELETE FROM tokens WHERE user_id = '{$user_data[0]->id}'");
                return response()->json([
                    'message' => 'Unauthorized',
                    'expire_date' => $user_data[0]->expire_date,
                    'time' => time()
                ], 401);
            }

            if($user_data[0]->jwt_token != $token) {
                DB::delete("DELETE FROM tokens WHERE user_id = '{$user_data[0]->id}'");
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }
            $request['user'] = $user_data[0];
            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
