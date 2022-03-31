<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // $category = Category::where('id', 'like', '%' . $request->get('searchQuest') . '%' )->get();
        $posts = Post::where('category_id', 'like', '%' . $request->get('searchQuest') . '%' )->get();
        
        return json_encode($posts);
    }
}
