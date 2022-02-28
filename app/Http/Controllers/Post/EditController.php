<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use App\Models\Post;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Request $request,$id)
    {
        $posts =Post::find($id);
        if ($posts){
            return response()->json([
                'status' => 200,
                'posts' => $posts,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Post not found',
            ]);
        }

    }
}
