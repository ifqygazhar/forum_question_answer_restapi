<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            //validation request
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);

            //if validator fail
            if ($validator->fails()) {
                return response()->json(
                    $validator->errors(), 409
                );
            }

            $name = $request->name;
            $username = $request->username;
            $email = $request->email;
            $password = $request->password;

            //create user
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => bcrypt($password),
            ]);

            //event(new Registered($user));

            //if success
            if ($user) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'success register user',
                    'code' => 201,
                    'user' => $user,
                ], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            //failed create user
            return response()->json([
                'status' => false,
                'code' => 409,
                'message' => $e->getMessage() //'failed register user',
            ], 409);

        }
    }
}
