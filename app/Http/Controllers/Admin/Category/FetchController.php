<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class FetchController extends Controller
{
    public function __invoke()
    {

        $categories = Category::all();

        return response()->json([
            'categories'=>$categories,
        ]);
    }
}
