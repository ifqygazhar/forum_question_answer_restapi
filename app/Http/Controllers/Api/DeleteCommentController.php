<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteCommentController extends Controller
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
            $comment = Comment::where('username_comment','=',$username)->where('id','=',$id)->delete($id);

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
                   'message' => 'success delete comment',
                   'code' => 200,
                ],200);
            }

        }catch (\Exception $e){
            return response()->json([
               'status' => false,
               'message' => 'failed delete comment',
               'code' => 409,
            ],409);
        }
    }
}
