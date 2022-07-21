<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,string $username,$id): JsonResponse
    {
        DB::beginTransaction();
        try {
            //validation request
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);

            //if validator fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 409);
            }

            //update
            $user = User::where('username','=',$username)->where('id','=',$id)->update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            if (!$user){
                return response()->json([
                   'status' => false,
                   'message' => 'user not found',
                   'code' => 404,
                ],404);
            }

            //if success
            if ($user) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'success update user',
                    'code' => 200,
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            //failed update
            return response()->json([
                'status' => false,
                'message' => 'failed update user',
                'code' => 409,
            ], 409);
        }
    }
}
