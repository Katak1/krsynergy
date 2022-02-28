<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DestroyController extends Controller
{
    public function __invoke(Post $post,$id)
    {

        $post->find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Post deleted successfully',
        ]);
    }
}
