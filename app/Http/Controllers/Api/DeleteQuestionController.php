<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteQuestionController extends Controller
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

            //question get username and id, delete by id
            $question = Question::where('user_name', '=', $username)->where('id', '=', $id)->delete($id);

            //if username and id not found
            if (!$question) {
                return response()->json([
                    'status' => false,
                    'message' => 'user or question not found',
                    'code' => 404,
                ], 404);
            }

            //if username and id found
            if ($question){
                DB::commit();
                return response()->json([
                    'status'=> true,
                    'message' => 'success delete question',
                    'code' => 200,
                ],200);
            }

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
               'status' => false,
               'message' => 'failed delete question',
               'code' => 404,
            ],404);
        }
    }
}
