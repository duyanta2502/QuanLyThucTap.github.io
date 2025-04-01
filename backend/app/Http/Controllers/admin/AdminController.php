<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getAccoutInfo()
    {
        $user = Auth::user();
        return response()->json([
            'user'=> $user,
        ]);
    }
    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.\Auth::user()->id,
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors(),
            ],422);
        }

        $user = \Auth::user()->update($request->all());

        if(!$user){
            return response()->json([
                'message' => 'Error updating user',
            ]);
        }
        return response()->json([
            'message' => 'User updated successfully',
        ]);
    }
}