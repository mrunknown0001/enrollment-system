<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarLoginController extends Controller
{
    

    // method to view registar login form
    public function login()
    {
    	return view('registrar-login');
    }
}
