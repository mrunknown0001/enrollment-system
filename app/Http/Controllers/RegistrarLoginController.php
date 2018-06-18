<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

class RegistrarLoginController extends Controller
{
    

    // method to view registar login form
    public function login()
    {
    	return view('registrar-login');
    }


    // method use to login registrar
    public function postLogin(Request $request)
    {
    	// validate request data
    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	// assign validated data to variable
    	$username = $request['username'];
    	$password = $request['password'];

    	// check


    	// authenticate attempt
    	// activity log
    	// return with return message
    	if(Auth::guard('registrar')->attempt(['username' => $username, 'password' => $password])) {
    		// add activity log
    		GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Registrar Login');

    		// return to view
    		return redirect()->route('registar.dashboard');
    	}
    	

    	// return with error message 
    	return redirect()->route('registrar.login')->with('error', 'Authentication Error!');
    }
}
