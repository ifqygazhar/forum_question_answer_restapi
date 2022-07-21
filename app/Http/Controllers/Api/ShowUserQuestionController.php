<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowUserQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$id,string $title): JsonResponse
    {

        $question = Question::leftjoin('answers','answers.question_id','=','questions.id')
            ->leftJoin('comments','comments.answer_id','=','answers.id')
            ->select(
            'questions.id','questions.user_name','questions.title','questions.tags','questions.description',
            'answers.username_answer','answers.answer','comments.username_comment','comments.comment'
        )->where('questions.id','=',$id)->where('questions.title','=',$title)->get();

        if ($question){
            return response()->json([
               'status' => true,
               'message' => 'success get data',
               'code' => 200,
               'question' => $question,
            ],200);
        }
    }
}
