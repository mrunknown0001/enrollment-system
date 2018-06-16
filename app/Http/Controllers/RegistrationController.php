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


    // method use to register student
    public function postRegistration(Request $request)
    {
    	return date('M d, Y', strtotime($request['date_of_birth']));
    }
}
