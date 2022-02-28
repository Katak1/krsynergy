<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;


class IndexController extends Controller
{
    public function __invoke()
    {

        $category = Category::all();
        $posts = Post::all();


        return view('post.index', compact('posts', 'category'));
    }
}
