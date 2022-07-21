<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateAnswerController extends Controller
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

            //validation request from user
            $validator = Validator::make($request->all(),[
               'answer' => 'required',
            ]);

            //if validation fail
            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            //update comment where username and id answers table
            $answer = Answer::where('username_answer','=',$username)->where('id','=',$id)->update([
                'answer' => $request->answer,
            ]);

            //if not have answer
            if (!$answer){
                return response()->json([
                   'status' => false,
                   'message' => 'user or answer not found',
                   'code' => 404,
                ],404);
            }

            //if success
            if ($answer){
                DB::commit();
                return response()->json([
                   'status' => true,
                   'message' => 'success update answer',
                   'code' => 200,
                ],200);
            }

        }catch (\Exception $e){
            DB::rollBack();
            //all false
            return response()->json([
               'status' => false,
               'message' => 'failed update answer',
               'code' => 409,
            ],409);
        }
    }
}
