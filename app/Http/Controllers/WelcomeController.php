<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Routing\Controller as BaseController;


class WelcomeController extends BaseController
{
    public function index(){
        if (count(Post::all())==0) {
            return view('welcome2');
        } else{
            $post = Post::all();
            $posts = Post::find(random_int(1, (count($post))));

            return view('welcome', compact('posts'));
        }
    }
}
