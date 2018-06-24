<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Faculty;
use App\FacultyInfo;

use App\Http\Controllers\GeneralController;

class FacultyRegistrationController extends Controller
{
    
    // method use to show facutly registration form
    public function registration()
    {
    	return view('faculty-registration');
    }


    // method use to register faculty
    public function postRegistration(Request $request)
    {
    	// validate request data
    	$request->validate([
    		'id_number' => 'required|unique:faculties',
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'mobile_number' => 'required|unique:faculties',
    		'password' => 'required|confirmed',
    		'date_of_birth' => 'required',
    		'place_of_birth' => 'required',
    		'address' => 'required',
    		'nationality' => 'required',
    		'agree' => 'required'
    	]);

    	// assign values to variables
    	$id = $request['id_number'];
    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$mobile = $request['mobile_number'];
    	$password = $request['password'];
    	$dob = $request['date_of_birth'];
    	$pob = $request['place_of_birth'];
    	$address = $request['address'];
    	$nationality = $request['nationality'];


    	// additional checks


    	// save data to register faculty
    	$f = new Faculty();
    	$f->id_number = $id;
    	$f->firstname = $firstname;
    	$f->lastname = $lastname;
    	$f->mobile_number = $mobile;
    	$f->password = bcrypt($password);
    	$f->save();

    	$info = new FacultyInfo();
    	$info->faculty_id = $f->id;
    	$info->date_of_birth = date('Y-d-m', strtotime($dob));
    	$info->place_of_birth = $pob;
    	$info->address = $address;
    	$info->nationality = $nationality;
    	$info->save();


    	// add activity log
    	GeneralController::activity_log($f->id, 3, 'Faculty Registration');

    	// return redirect
    	return redirect()->route('faculty.registration')->with('success', 'Registration Successful!');


    }
}
