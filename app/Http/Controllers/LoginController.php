<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    	// return login view for student login
    	return view('student-login');
    }
}
