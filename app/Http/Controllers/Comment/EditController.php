<?php

namespace App\Http\Controllers\Commnet;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Request $request,$id)
    {
        $comment = Comment::find($id);
        if ($comment){
            return response()->json([
                'status' => 200,
                'comment' => $comment,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Comment not found',
            ]);
        }

    }
}
