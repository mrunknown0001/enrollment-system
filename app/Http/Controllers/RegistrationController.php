<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

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
    	// return date('M d, Y', strtotime($request['date_of_birth']));
        return GeneralController::generate_student_number();
    }
}
