<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard View
     * @author Shani Singh
     */
    public function index(){
        return view('superadmin.dashboard');
    }
}
