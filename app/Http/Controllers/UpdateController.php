<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{



    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'passport_number' => ['required', 'integer', 'min:100000', 'max:999999'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $users = User::find($id);
            if ($users){

                $users->update([
                    'name' => $request->input('name'),
                    'surname'=>$request->input('surname'),
                    'email'=>$request->input('email'),
                    'passport_number'=>$request->input('passport_number'),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'User updated successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found',
                ]);
            }
        }
    }



}
