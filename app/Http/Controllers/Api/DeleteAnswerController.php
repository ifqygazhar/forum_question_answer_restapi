<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteAnswerController extends Controller
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
            $answer = Answer::where('username_answer', '=', $username)->where('id', '=', $id)->delete($id);

            if (!$answer){
                return response()->json([
                   'status' => false,
                   'message' => 'user or answer not found',
                   'code' => 404,
                ],404);
            }

            if ($answer){
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'success delete answer',
                    'code' => 200,
                ],200);
            }

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
               'status' => false,
               'message' => 'failed delete answer',
               'code' => 409,
            ],409);
        }
    }
}
