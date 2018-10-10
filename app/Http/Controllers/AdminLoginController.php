<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

class AdminLoginController extends Controller
{
    
    // method use to view login for admin
    public function login()
    {
    	return GeneralController::auth_check('admin-login');
    }


    // method use to login admin
    public function postLogin(Request $request)
    {
    	// validate request data
    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);


    	// assign request data to variables
    	$username = $request['username'];
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
    	// redirect to dashboard
    	if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password, 'active' => 1])) {

    		// add activity log
    		GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Login');

    		// redirect to admin dashboard
    		return redirect()->route('admin.dashboard');
    	}

    	return redirect()->route('admin.login')->with('error', 'Authentication Error!');
    }
}
