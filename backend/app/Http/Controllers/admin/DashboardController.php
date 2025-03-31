<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function countUser()
    {
        return User::count();
    }
    public function getNameUser(){
        $user = Auth::user();
        return $user->name;
    }

    /**
     * Store a newly created resource in storage.
     */

}
