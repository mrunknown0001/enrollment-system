<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyRegistrationController extends Controller
{
    
    // method use to show facutly registration form
    public function registration()
    {
    	return view('faculty-registration');
    }
}
