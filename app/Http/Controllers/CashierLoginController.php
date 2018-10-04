<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

class CashierLoginController extends Controller
{
    
    // method to show cashier login form 
    public function login()
    {
    	return view('cashier-login');
    }


    // method use to login cashier
    public function postLogin(Request $request)
    {
    	// validate request data
    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	// assgin values to variable
    	$username = $request['username'];
    	$password = $request['password'];

        // check if there is a session 
        GeneralController::auth_check('welcome');


    	// autheticate attempt
    	// add activity log
    	// return redirect to route
    	if(Auth::guard('cashier')->attempt(['username' => $username, 'password' => $password])) {
    		
    		GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Cashier Login');

    		return redirect()->route('cashier.dashboard');
    	}


    	// return with error message
    	return redirect()->route('cashier.login')->with('error', 'Authentication Error!');

    }
}
