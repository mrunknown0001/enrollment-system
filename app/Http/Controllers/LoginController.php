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
        // check if there is authenticated user
        return GeneralController::auth_check($view = 'welcome');
	}


    // method use to view login form of students
    public function login()
    {
    	// codition and validation
        // check if ther eis any authenticated user
        return GeneralController::auth_check($view = 'student-login');

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


        if(Auth::check()) {
            return redirect()->route('student.dashboard');
        }
        elseif (Auth::guard('faculty')->check()) {
            return redirect()->route('faculty.dashboard');
        }
        elseif(Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::guard('cashier')->check()) {
            return redirect()->route('cashier.dashboard');
        }
        elseif(Auth::guard('registrar')->check()) {
            return redirect()->route('registrar.dashboard');
        }

        // attempt to login the user
        if(Auth::attempt(['student_number' => $sn, 'password' => $pass, 'active' => 1])) {
            // addition conditions if any


            // add activity log
            GeneralController::activity_log(Auth::user()->id, 5, 'Student Login');


            // return to desired page
            return redirect()->route('student.dashboard');
            

        }


        // return error message
        return redirect()->route('student.login')->with('error', 'Incorrect Student Number or Password!');

    }
}
