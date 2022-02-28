<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $category = Category::all();

        return view('admin.category.index', compact('category'));
    }
}
