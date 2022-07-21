<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): JsonResponse
    {
        //validation request
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        //if validator fails
        if ($validator->fails()){
            return response()->json($validator->errors(),401);
        }

        //get credential from users
        $credential = $request->only('email','password');

        //if auth failed
        if (!$token = auth()->guard('api')->attempt($credential)){
            return response()->json([
               'success' => false,
               'message' => 'Email or password is wrong',
               'code' => 401,
            ],401);
        }

        //if auth success and user login
        return response()->json([
           'success' => true,
           'message' => 'Success login',
           'code' => '200',
           'user' => auth()->guard('api')->user(),
           'token' => $token,
        ]);

    }
}
