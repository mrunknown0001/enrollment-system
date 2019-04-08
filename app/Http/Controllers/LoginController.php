<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\UserPasswordReset;

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SmsController;

class LoginController extends Controller
{


	// method use to show welcome page of the site
	public function welcome()
	{
        // check if there is authenticated user
        return GeneralController::auth_check($view = 'welcome');
	}


    // method use to view login form of students
    public function login()
    {
    	// codition and validation
        // check if ther eis any authenticated user
        return GeneralController::auth_check($view = 'student-login');

    }


    // methdo use to post login student
    public function postLogin(Request $request)
    {
        // validate request data
        $request->validate([
            'student_number' => 'required',
            'password' => 'required',
            'terms' => 'required'
        ]);

        // assign request data to variable
        $sn = $request['student_number'];
        $pass = $request['password'];


        if(Auth::check()) {
            return redirect()->route('student.dashboard');
        }
        elseif (Auth::guard('faculty')->check()) {
            return redirect()->route('faculty.dashboard');
        }
        elseif(Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::guard('cashier')->check()) {
            return redirect()->route('cashier.dashboard');
        }
        elseif(Auth::guard('registrar')->check()) {
            return redirect()->route('registrar.dashboard');
        }

        // attempt to login the user
        if(Auth::attempt(['student_number' => $sn, 'password' => $pass, 'active' => 1])) {
            // addition conditions if any


            // add activity log
            GeneralController::activity_log(Auth::user()->id, 5, 'Student Login');


            // return to desired page
            return redirect()->route('student.dashboard');
            

        }


        // return error message
        return redirect()->route('student.login')->with('error', 'Incorrect Student Number or Password!');

    }


    // method use to access forgot passwod
    public function forgotPassword()
    {
        // return view here 
        return view('student-password-reset');
    }


    // method use to find student using student number
    // and send reset code for reset password
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'student_number' => 'required'
        ]);

        $student_number = $request['student_number'];

        // search student, if no result return a message
        $student = User::where('student_number', $student_number)->first();

        // if there is result send a code to the registered number
        if(count($student) < 1) {
            return redirect()->back()->with('error', 'No Student Found!');
        }

        // generate reset code
        $code = GeneralController::generate_reset_code();
        // send code
        $message = 'Your Reset Code is ' . $code;

        SmsController::sendSms($student->mobile_number, $message);

        // add to user reset code
        $reset = new UserPasswordReset();
        $reset->student_id = $student->id;
        $reset->code = $code;
        $reset->save();


        // add to activity log
        GeneralController::activity_log($student->id, 5, 'Student Password Attempt');

        // return a view for password reset
        return view('student-password-reset-enter-code', ['student' => $student]);


    }


    // method use to reset password
    public function postPasswordReset(Request $request)
    {
        $request->validate([
            'reset_code' => 'required'
        ]);

        $id = $request['student_id'];
        $code = $request['reset_code'];

        $student = User::findorfail($id);

        // check reset code if valid or not expired
        $r_code = UserPasswordReset::where('student_id', $student->id)->orderBy('created_at', 'desc')->first();

        if($r_code->active != 1) {
            return redirect()->route('student.forgot.password')->with('error', 'Please Try Again');
        }

        if($code != $r_code->code) {
            return redirect()->back()->with('error', 'Invalid Reset Code.');
        }

        return view('student-password-reset-new-pass', ['student' => $student]);
    }


    // method use to reset password
    public function postPasswordNew(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $id = $request['student_id'];
        $password = $request['password'];

        $student = User::findorfail($id);

        $student->password = bcrypt($password);
        $student->save();

        GeneralController::activity_log($student->id, 5, 'Student Password Reset Success');

        return redirect()->route('student.login')->with('success', 'Password Reset Successful!');
    }
}
