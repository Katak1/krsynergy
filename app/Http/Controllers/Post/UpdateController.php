<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Services\Post\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request,Service $service,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id'=> '',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $post = Post::find($id);
            if ($post){
                $service->update($post,[
                    'title' => $request->input('title'),
                    'content'=>$request->input('content'),
                    'category_id'=>$request->input('category_id'),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Post updated successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Post not found',
                ]);
            }
        }

    }
}
