<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Redirect Based on role
        if(Auth::user()->role_id == 1){
            // Superadmin
            return redirect()->route('superadmin.dashboard');
        }elseif(Auth::user()->role_id == 2){
            // Admin
            return redirect()->route('admin.dashboard');
        }

        
        return view('home');
    }
}
