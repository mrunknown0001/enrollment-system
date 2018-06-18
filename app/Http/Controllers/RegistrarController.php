<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:registrar');
    }

    // method use to view registrar dashboard
    public function dashboard()
    {
    	return 'Registrar Dashboard';
    }
}
