<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteUserController extends Controller
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
            //delete by id
            $user = User::where('username','=',$username)->where('id','=',$id)->delete($id);

            if (!$user){
                return response()->json([
                    'status' => false,
                    'message' => 'user not found',
                    'code' => 404,
                ],404);
            }

            if ($user) {
                //if success deleted response
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'user success deleted',
                    'code' => 200,
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            //if failed deleted response
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'code' => 404,
            ], 404);
        }
    }
}
