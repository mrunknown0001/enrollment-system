<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
    }


    // method to show the dashboard of student
    public function dashboard()
    {
    	// get all the data need to show in dashboard of student

    	return 'Student Dashboard';
    }
}
