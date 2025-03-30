<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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

    /**
     * Store a newly created resource in storage.
     */

}