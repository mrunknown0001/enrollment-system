<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

class LoginController extends Controller
{


	// method use to show welcome page of the site
	public function welcome()
	{

		return view('welcome');

	}


    // method use to view login form of students
    public function login()
    {
    	// codition and validation
        // check if ther eis any authenticated user
        

    	// return login view for student login
    	return view('student-login');
    }


    // methdo use to post login student
    public function postLogin(Request $request)
    {
        // validate request data
        $request->validate([
            'student_number' => 'required',
            'password' => 'required'
        ]);

        // assign request data to variable
        $sn = $request['student_number'];
        $pass = $request['password'];

        // attempt to login the user
        if(Auth::attempt(['student_number' => $sn, 'password' => $pass])) {
            // addition conditions if any


            // add activity log
            GeneralController::activity_log(Auth::user()->id, 5, 'Student Login');


            // return to desired page
            return 'Login Successful!';
            

        }


        // return error message
        return redirect()->route('student.login')->with('error', 'Incorrect Student Number or Password!');

    }
}
