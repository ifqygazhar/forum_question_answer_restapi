<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,string $username): JsonResponse
    {
        DB::beginTransaction();

        try {
            //validate request
            $validator = Validator::make($request->all(),[
               'title' => 'required|max:150',
               'description' => 'required',
            ]);

            //if fails
            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            //get username from table users
            $user = User::where('username',$username)->first();

            //if username not found
            if (!$user){
                return response()->json([
                    'status' => false,
                    'message' =>  'user not found',
                    'code' => 404
                ],404);
            }

            //insert data to question table
            $question = Question::create([
               'user_name' => $user->username,
               'title'=> str_replace(' ','-',strtolower($request->title)),
               'tags' => $request->tags,
               'description' => $request->description,
               //'user_id' => $user->id,
            ]);

            //if insert question success
            if ($question){
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'success create question',
                    'code' => 201,
                    'question' => $question,
                ],201);
            }
        }catch (\Exception $e){
            //if question failed insert
            DB::rollBack();
            return response()->json([
               'status' => false,
               'message' =>  $e->getMessage(), //'failed create question',
               'code' => 409
            ],409);
        }
    }
}
