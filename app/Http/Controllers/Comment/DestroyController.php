<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class DestroyController extends Controller
{
    public function __invoke(Comment $comment,$id)
    {

        $comment->find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Comment deleted successfully',
        ]);
    }
}
