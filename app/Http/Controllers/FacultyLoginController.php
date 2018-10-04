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
    	return GeneralController::auth_check('faculty-login');
    }


    // method use to login faculty
    public function postLogin(Request $request)
    {
    	// validate request data
    	$request->validate([
    		'id_number' => 'required',
    		'password' => 'required'
    	]);

    	// assign variables to data
    	$id = $request['id_number'];
    	$password = $request['password'];


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

    	// attempt to login
    	if(Auth::guard('faculty')->attempt(['id_number' => $id, 'password' => $password])) {
    		// add activity log
    		GeneralController::activity_log(Auth::guard('faculty')->user()->id, 3, 'Faculty Login');

    		// return
    		return redirect()->route('faculty.dashboard');

    	}

    	// return redirect error message
    	return redirect()->route('faculty.login')->with('error', 'Authentication Error!');

    }
}
