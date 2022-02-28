<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class FetchController extends Controller
{
    public function __invoke()
    {

        $posts = Post::all();

        return response()->json([
            'posts'=>$posts,
        ]);
    }
}
