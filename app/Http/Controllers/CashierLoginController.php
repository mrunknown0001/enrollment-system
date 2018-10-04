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
        return GeneralController::auth_check('cashier-login');
    	// return view('cashier-login');
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
