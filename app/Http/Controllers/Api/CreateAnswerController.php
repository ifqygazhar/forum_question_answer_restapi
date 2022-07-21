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

class CreateAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$id,string $username): JsonResponse
    {
        DB::beginTransaction();

        try {

            //validation request from user
            $validator = Validator::make($request->all(), [
                'answer' => 'required',
            ]);

            //if validation fail
            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            //get username from users and id from question
            $user = User::where('username',$username)->first();
            $question = Question::where('id',$id)->first();

            //if not have user or question
            if (!$user || !$question){
                return response()->json([
                   'status' => false,
                   'message' => 'user or question not found',
                   'code' => 404,
                ],404);
            }

            //create answer
            $answer = Answer::create([
               'username_answer' => $user->username,
               'answer' => $request->answer,
               'question_id' => $question->id,
            ]);

            //if answer success
            if ($answer){
                DB::commit();
                return response()->json([
                   'status' => true,
                   'message' => 'success create answer',
                   'code' => 201,
                   'answer' => $answer,
                ],201);
            }

        }catch (\Exception $e){
            DB::rollBack();
            //if all false
            return response()->json([
               'status' => false,
               'message' => 'failed create answer',
               'code' => 409,
            ],409);
        }
    }
}
