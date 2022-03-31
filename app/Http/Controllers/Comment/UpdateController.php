<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Services\Comment\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request,Service $service,$id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|text',
            'post_id' => '',
            'user_id'=> '',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $comment = Comment::find($id);
            if ($comment){
                $service->update($comment,[
                    'message' => $request->input('message'),
                    'post_id'=>$request->input('post_id'),
                    'user_id'=>$request->input('user_id'),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment updated successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Comment not found',
                ]);
            }
        }

    }
}
