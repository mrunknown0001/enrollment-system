<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    
    // method use to view registration form for students
    public function registration()
    {
    	return view('student-registration');
    }
}
