<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()){
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
        }

        if(!Auth::attempt($request->all())){
            throw ValidationException::withMessages([
                'msg' => 'Email or password is incorrect'
            ]);
        }



        return response()->json([
            'message' => 'User login successfully',
        ], 201);
    }
}