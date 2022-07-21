<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateCommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$id,$id_answer,string $username): JsonResponse
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(),[
               'comment' => 'required',
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $user = User::where('username',$username)->first();
            $question = Question::where('id',$id)->first();
            $answer = Answer::where('id',$id_answer)->first();

            if (!$user || !$question || !$answer){
                return response()->json([
                    'status' => false,
                    'message' => 'user or question or answer not found',
                    'code' => 404,
                ],404);
            }

            $comment = Comment::create([
               'username_comment' => $user->username,
               'comment' => $request->comment,
               'question_id' => $question->id,
               'answer_id' => $answer->id,
            ]);

            if ($comment){
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'success create comment',
                    'code' => 201,
                    'comment' => $comment,
                ],201);
            }
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'failed create comment',
                'code' => 409
            ],409);
        }
    }
}
