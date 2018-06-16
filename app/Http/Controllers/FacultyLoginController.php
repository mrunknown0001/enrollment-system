<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyLoginController extends Controller
{
    
    // method use to show login form for faculty
    public function login()
    {
    	return view('faculty-login');
    }
}
