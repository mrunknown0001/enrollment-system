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

    	return view('student.dashboard');
    }


    // method to show profile of the student
    public function profile()
    {
        return view('student.profile');
    }


    // method to show profile update form
    public function updateProfile()
    {
        return view('student.profile-update');
    }
}
