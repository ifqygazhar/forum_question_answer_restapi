<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => 'token is invalid'], 403);
            }else if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => 'token is expired'],401);
            }else if($e instanceof TokenBlacklistedException){
                return response()->json(['status' => 'token is blacklist'], 404);
            }else {
                return response()->json(['status' => 'authorization token not found'],404);
            }
        }
        return $next($request);
    }
}
