<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Get Welcome Page
     * @param Nill
     * @return Return to Welcome page
     * @author Shani Singh
     */
    public function getWelcomePage()
    {
        return view('frontend.welcome');
    }
}
