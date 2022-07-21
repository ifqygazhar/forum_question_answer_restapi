<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateCommentController extends Controller
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
            $validator = Validator::make($request->all(),[
               'comment' => 'required',
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $comment = Comment::where('username_comment','=',$username)->where('id','=',$id)->update([
               'comment' => $request->comment,
            ]);

            if (!$comment){
                return response()->json([
                    'status' => false,
                    'message' => 'user or comment not found',
                    'code' => 404,
                ],404);
            }

            if ($comment){
                DB::commit();
                return response()->json([
                   'status' => true,
                   'message' => 'success update comment',
                   'code' => 200,
                ],200);
            }

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'failed create comment',
                'code' => 409,
            ],409);
        }
    }
}
