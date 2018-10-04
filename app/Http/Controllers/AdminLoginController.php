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

        // check if there is a session 
        GeneralController::auth_check('welcome');

    	// attempt to login
    	// redirect to dashboard
    	if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password])) {

    		// add activity log
    		GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Login');

    		// redirect to admin dashboard
    		return redirect()->route('admin.dashboard');
    	}

    	return redirect()->route('admin.login')->with('error', 'Authentication Error!');
    }
}
