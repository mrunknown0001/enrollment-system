<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    
    // method use to view login for admin
    public function login()
    {
    	return view('admin-login');
    }
}
