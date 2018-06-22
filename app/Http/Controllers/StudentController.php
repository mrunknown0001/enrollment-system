<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\StudentInfo;

use App\Http\Controllers\GeneralController;

class StudentController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
    }


    // method to show the dashboard of student
    public function dashboard()
    {
    	// get all the data need to show in dashboard of student

    	return view('student.dashboard');
    }


    // method to show profile of the student
    public function profile()
    {
        return view('student.profile');
    }


    // method to show profile update form
    public function updateProfile()
    {
        return view('student.profile-update');
    }


    // method to update profile
    public function postUpdateProfile(Request $request)
    {
        // validate request form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'address' => 'required',
            'nationality' => 'required'
        ]);

        // assign form data in variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $mobile = $request['mobile_number'];
        $dob = $request['date_of_birth'];
        $pob = $request['place_of_birth'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        // check


        // register/save the information of the student
        $user = User::findorfail(Auth::user()->id);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->mobile_number = $mobile;
        $user->save();

        $info = StudentInfo::findorfail(Auth::user()->info->id);
        $info->date_of_birth = date('Y-d-m', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->address = $address;
        $info->nationality = $nationality;
        $info->save();

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 5, 'Update Student Profile');

        // return message
        return redirect()->route('student.profile')->with('success', 'Profile Updated!');

    }


    // method to view change password form
    public function changePassword()
    {
        return view('student.change-password');
    }
    

    // method use to save change password
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
        if(password_verify($old, Auth::user()->password)) {
            // change the password
            $admin = User::findorfail(Auth::user()->id);
            $admin->password = bcrypt($new);
            $admin->save();

            // activity log
            GeneralController::activity_log(Auth::user()->id, 1, 'Student Change Password');

            return redirect()->route('student.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('student.password.change')->with('error', 'Old Password Invalid!');
    }

}
