<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): JsonResponse
    {
        $question = Question::latest()->paginate(5);

        if ($question){
            return response()->json([
               'status' => true,
               'message' => 'List Data Question',
               'code' => 200,
               'question' => $question,
            ],200);
        }
    }
}
