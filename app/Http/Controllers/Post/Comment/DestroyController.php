<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use PhpOption\None;

class DestroyController extends Controller
{
    public function __invoke(Comment $comment,$id,$comid)
    {

        if (auth()->user() !== null ) {
            if (auth()->user()->id == $comment->find($comid)->user_id){
                $comment->find($comid)->delete();
            return redirect()->route('posts.Show',Post::find($id));
            } else{
                    return redirect()->route('posts.Show',Post::find($id));
            }
        }else{
            return redirect()->route('posts.Show',Post::find($id));
        }

    }
}
