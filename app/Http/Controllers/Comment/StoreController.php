<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Services\Comment\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{

    public function __invoke(Request $request, Service $service)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'post_id'=> '',
            'user_id'=> '',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            $service->store([
                'message'=>$request->input('message'),
                'post_id'=>$request->input('post_id'),
                'user_id'=>$request->input('user_id'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Comment created successfully',
            ]);
        }
    }
}
