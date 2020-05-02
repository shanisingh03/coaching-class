<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard View
     * @author Shani Singh
     */
    public function index(){
        // dd(auth()->user()->institute);
        return view('admin.dashboard');
    }
}
