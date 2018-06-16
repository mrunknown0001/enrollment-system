<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierLoginController extends Controller
{
    
    // method to show cashier login form 
    public function login()
    {
    	return view('cashier-login');
    }
}
