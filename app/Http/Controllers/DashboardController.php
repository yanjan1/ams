<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard(Request $request){
        $user = Auth::user();
        return view('dashboard.main', ["user" => $user]);
    }
}
