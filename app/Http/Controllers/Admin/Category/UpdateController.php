<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Services\Category\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request,Service $service,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $category = Category::find($id);
            if ($category){
                $service->update($category,[
                    'title' => $request->input('title')
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Category updated successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Category not found',
                ]);
            }
        }

    }
}
