<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

class FacultyLoginController extends Controller
{
    
    // method use to show login form for faculty
    public function login()
    {
    	return view('faculty-login');
    }


    // method use to login faculty
    public function postLogin(Request $request)
    {
    	return $request;
    }
}
