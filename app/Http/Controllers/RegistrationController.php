<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\StudentInfo;
use App\ActivityLog;

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SmsController;

class RegistrationController extends Controller
{
    
    // method use to view registration form for students
    public function registration()
    {
    	return view('student-registration');
    }


    // method use to register student
    public function postRegistration(Request $request)
    {
    	// validate form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile_number' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'date_of_birth' => 'required',
            'place_of_birth'=> 'required',
            'address' => 'required',
            'nationality' => 'required'
        ]);

        // assign data to variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $mobile = $request['mobile_number'];
        $password = $request['password'];
        $dob = $request['date_of_birth'];
        $pob = $request['place_of_birth'];
        $address = $request['address'];
        $nationality = $request['nationality'];

        $student_number = GeneralController::generate_student_number();

        // register/save the information of the student
        $user = new User();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->student_number = $student_number;
        $user->mobile_number = $mobile;
        $user->password = bcrypt($password);
        $user->save();

        $info = new StudentInfo();
        $info->student_id = $user->id;
        $info->date_of_birth = date('Y-d-m', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->address = $address;
        $info->nationality = $nationality;
        $info->save();


        ///////////////////////////////////////////////////////////////////////
        // send the confirmation sms with the student number to the student  //
        ///////////////////////////////////////////////////////////////////////
        $message = "ICT Online Enrollment System %0a Your system generated Student Number: " . $student_number;
        // SmsController::sendSms($mobile, $message);


        // add activity log here
        GeneralController::activity_log($user->id, 5, 'Register Student Account');

        // reguturn to registration page with success message
        return redirect()->route('student.login')->with('success', 'Account Created! Your Student Number is ' . $student_number)->with('student_number', $student_number);


    }
}
