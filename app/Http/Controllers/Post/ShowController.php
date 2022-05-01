<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;


class ShowController extends Controller
{
    public function __invoke($id)
    {
        $category = Category::all();
        $posts = Post::find($id);
        $comments = Comment::all();
        $comment = $comments->where('post_id', $posts->id);



        return view('post.show', compact('posts', 'category', 'comment'));
    }
}
