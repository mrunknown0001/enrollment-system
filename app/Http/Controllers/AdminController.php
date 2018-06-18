<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
    	$this->middleware(['auth:admin', 'check_admin']);
    }

    // method use to view admin dashboard
    public function dashboard()
    {
    	return 'Admin Dashboard';
    }
}
