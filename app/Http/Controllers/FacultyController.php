<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Faculty;
use App\FacultyInfo;

use App\Http\Controllers\GeneralController;

class FacultyController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:faculty');
    }


    // method use to view dashboard of faculty
    public function dashboard()
    {
    	return view('faculty.dashboard');
    }


    // method use to view profile of the faculty
    public function profile()
    {
    	return view('faculty.profile');
    }


    // method use to view form update of profile
    public function updateProfile()
    {
    	return view('faculty.profile-update');
    }


    // method use to update profile of faculty
    public function postUpdateProfile(Request $request)
    {
    	// validate request form data
    	$request->validate([
			'firstname' => 'required',
            'lastname' => 'required',
            'id_number' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'address' => 'required',
            'nationality' => 'required'
    	]);

    	// assign form data in variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];
        $dob = $request['date_of_birth'];
        $pob = $request['place_of_birth'];
        $address = $request['address'];
        $nationality = $request['nationality'];

    	// check


    	// save
        $faculty = Faculty::findorfail(Auth::guard('faculty')->user()->id);
        $faculty->firstname = $firstname;
        $faculty->lastname = $lastname;
        $faculty->id_number = $id;
        $faculty->mobile_number = $mobile;
        $faculty->save();

        $info = FacultyInfo::findorfail($faculty->id);
        $info->date_of_birth = date('Y-d-m', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->address = $address;
        $info->nationality = $nationality;
        $info->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 2, 'Update Facutly Profile');

        // return message
        return redirect()->route('faculty.profile')->with('success', 'Profile Updated!');

    }


    // method use to view password change 
    public function changePassword()
    {
    	return view('faculty.change-password');
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
        if(password_verify($old, Auth::guard('faculty')->user()->password)) {
            // change the password
            $faculty = Faculty::findorfail(Auth::guard('faculty')->user()->id);
            $faculty->password = bcrypt($new);
            $faculty->save();

            // activity log
            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 2, 'Faculty Change Password');

            return redirect()->route('faculty.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('faculty.password.change')->with('error', 'Old Password Invalid!');
    }

}
