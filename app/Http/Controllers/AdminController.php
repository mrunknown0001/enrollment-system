<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    // method use to view admin dashboard
    public function dashboard()
    {

    	// load all need in admin dashboard


    	return view('admin.dashboard');
    }



    // method use to view casheirs
    public function viewCashiers()
    {
        return view('admin.cashiers');
    }
}
