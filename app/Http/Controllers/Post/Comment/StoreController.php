<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;



class StoreController extends Controller
{

    public function __invoke(Request $request,$id)
    {
            $data['message'] = $request->request->get('message');
            $data['post_id'] = Post::find($id)->id;
            $data['user_id'] = auth()->user()->id;

            Comment::create($data);

            return redirect()->route('posts.Show', Post::find($id));
        }

}
