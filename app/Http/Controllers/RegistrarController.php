<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\GeneralController;

use App\Registrar;

class RegistrarController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:registrar');
    }

    // method use to view registrar dashboard
    public function dashboard()
    {
    	return view('registrar.dashboard');
    }


    // method use to view profile of registrar
    public function profile()
    {
    	return view('registrar.profile');
    }

    // method use to view profiel update of registrar
    public function updateProfile()
    {
    	return view('registrar.profile-update');
    }


    // method use to update registrar profile
    public function postUpdateProfile(Request $request)
    {
        // validate request data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'id_number' => 'required',
            'mobile_number' => 'required'
        ]);

        // assign to varible
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];

        $registrar = Registrar::findorfail(Auth::guard('registrar')->user()->id);
        $registrar->firstname = $firstname;
        $registrar->lastname = $lastname;
        $registrar->id_number = $id;
        $registrar->mobile_number = $mobile;
        $registrar->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Update Registrar Profile');

        // return message
        return redirect()->route('registrar.profile')->with('success', 'Profile Updated!');
    }


    // method use to view password change form
    public function changePassword()
    {
    	return view('registrar.change-password');
    }

    // method use to update password
    public function postChangePassword(Request $request)
    {
        // validate request data
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        // assign request data to variables
        $old = $request['old_password'];
        $new = $request['password'];

        // if the password is same with old password
        if(password_verify($old, Auth::guard('registrar')->user()->password)) {
            // change the password
            $registrar = Registrar::findorfail(Auth::guard('registrar')->user()->id);
            $registrar->password = bcrypt($new);
            $registrar->save();

            // activity log
            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Registrar Change Password');

            return redirect()->route('registrar.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('registrar.password.change')->with('error', 'Old Password Invalid!');
    }


    // method use to view students
    public function viewStudents()
    {
        // get all students currently enrolled
        
        return view('registrar.students');
    }


    // method use to view courses
    public function viewCourses()
    {
        return view('registrar.courses');
    }


    // method use to view programs
    public function viewPrograms()
    {
        return view('registrar.programs');
    }


}
