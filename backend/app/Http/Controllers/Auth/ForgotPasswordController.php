<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class ForgotPasswordController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()){
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
        }

        try {
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email'=> $request->email,
                'token'=> $token,
                'created_at'=> Carbon::now()
            ]);

            Mail::send('email.forgotPassword',['token' => $token], function ($message) use ( $request) {
                $message->to($request ->email);
                $message->subject('Resset Password');
            });
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 422);
        }
        return response()->json([   'message'=> 'We have emailed reset passwor'],200);
    }

}