<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Services\Category\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller
{
    public function __invoke(Request $request,$id)
    {
        $categories =Category::find($id);
        if ($categories){
            return response()->json([
                'status' => 200,
                'categories' => $categories,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
            ]);
        }

    }
}
