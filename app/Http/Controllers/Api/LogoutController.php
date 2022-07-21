<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): JsonResponse
    {
        //get token jwt from user
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        //if success,user can logout
        if ($removeToken){
            return response()->json([
                'status' => true,
                'message' => 'succes logout',
                'code' => 200,
            ]);
        }
    }
}
