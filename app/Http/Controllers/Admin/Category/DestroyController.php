<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DestroyController extends Controller
{
    public function __invoke(Category $category,$id)
    {

        $category->find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Category deleted successfully',
        ]);
    }
}
