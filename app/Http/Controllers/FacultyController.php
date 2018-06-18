<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:faculty');
    }


    // method use to view dashboard of faculty
    public function dashboard()
    {
    	return 'Faculty Dashboard';
    }
}
