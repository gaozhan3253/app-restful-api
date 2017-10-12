<?php

namespace App\Api\V1\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Log;


class authJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            if ($user = JWTAuth::parseToken()->authenticate()) {
                //存在用户 判断用户是否有权限访问当前api
            } else {
                return response()->json(['message' => '用户不存在', 'status_code' => 404], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'token过期', 'status_code' => $e->getStatusCode()], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'token无效', 'status_code' => $e->getStatusCode()], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['message' => 'token不存在', 'status_code' => $e->getStatusCode()], $e->getStatusCode());
        }

        return $next($request);
    }
}
