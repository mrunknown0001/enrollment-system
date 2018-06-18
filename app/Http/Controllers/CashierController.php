<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:cashier');
    }

    // method use to view cashier dashboard
    public function dashboard()
    {
    	return 'Cashier Dashboard';
    }
}
