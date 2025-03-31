<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ResetPasswordController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
        }
        try{
            $updatePassword = DB::table('password_reset_tokens')->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();
            if(!$updatePassword){
                return response()->json(['message' => 'This token is invalid'], 422);
            }
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_reset_tokens')->where([
                'email' => $request->email,
                'token' => $request->token
            ])->delete();
        }catch(\Throwable $th){
            return response()->json([
                'message' => $th,
            ], 422);
        }
        return response()->json([
            'message' => "Chang password successfully",
        ], 201);
    }
}