<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Services\Category\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{

    public function __invoke(Request $request, Service $service)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            $service->store([
                'title'=>$request->input('title')
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Category created successfully',
            ]);
        }
    }
}
