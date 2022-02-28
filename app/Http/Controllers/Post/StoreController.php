<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Services\Post\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{

    public function __invoke(Request $request, Service $service)
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
        }
        else {
            $service->store([
                'title'=>$request->input('title'),
                'content'=>$request->input('content'),
                'category_id'=>$request->input('category_id'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Post created successfully',
            ]);
        }
    }
}
