<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Cashier;

use App\Http\Controllers\GeneralController;

class CashierController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:cashier');
    }

    // method use to view cashier dashboard
    public function dashboard()
    {
    	// get all data needed

    	return view('cashier.dashboard');
    }

    // method use to view profile of the cashier
    public function profile()
    {
        return view('cashier.profile');
    }


    // method use to view profile update form
    public function updateProfile()
    {
        return view('cashier.profile-update');
    }


    // method use to update profile
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

        $cashier = Cashier::findorfail(Auth::guard('cashier')->user()->id);
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->id_number = $id;
        $cashier->mobile_number = $mobile;
        $cashier->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Update Cashier Profile');

        // return message
        return redirect()->route('cashier.profile')->with('success', 'Profile Updated!');
    }

    // method use to password
    public function changePassword()
    {
        return view('cashier.change-password');
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
        if(password_verify($old, Auth::guard('cashier')->user()->password)) {
            // change the password
            $cashier = Cashier::findorfail(Auth::guard('cashier')->user()->id);
            $cashier->password = bcrypt($new);
            $cashier->save();

            // activity log
            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Cashier Change Password');

            return redirect()->route('cashier.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('cashier.password.change')->with('error', 'Old Password Invalid!');
    }
}
