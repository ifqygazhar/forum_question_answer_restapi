<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateQuestionController extends Controller
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
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    $validator->errors(), 400
                );
            }

            $question = Question::where('user_name','=',$username)->where('id' ,'=',$id)->update([
                'title' => $request->title,
                'tags' => $request->tags,
                'description' => $request->description,
            ]);

            if (!$question){
                return response()->json([
                   'status' => false,
                   'message' => 'user or question not found',
                   'code' => 404
                ],404);
            }

            if ($question){
                DB::commit();
                return response()->json([
                   'status' => true,
                   'message' => 'success update question',
                   'code' => 200,
                   'question' => $question,
                ],200);
            }

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
               'status' => false,
               'message' => 'failed create question',
               'code' => 409,
            ],409);
        }
    }
}
