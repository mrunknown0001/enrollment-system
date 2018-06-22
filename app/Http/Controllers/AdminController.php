<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Admin;
use App\Cashier;
use App\ActivityLog;
use App\Registrar;
use App\Program;

use App\Http\Controllers\GeneralController;

class AdminController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    // method use to view admin dashboard
    public function dashboard()
    {

    	// load all need in admin dashboard


    	return view('admin.dashboard');
    }


    // method use to view profile of the admin
    public function profile()
    {
        return view('admin.profile');
    }


    // method use to view update profile
    public function profielUpdate()
    {
        return view('admin.profile-update');
    }


    // method use to update profile of admin
    public function postProfileUpdate(Request $request)
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

        // update 
        $admin = Admin::findorfail(Auth::guard('admin')->user()->id);
        $admin->firstname = $firstname;
        $admin->lastname = $lastname;
        $admin->id_number = $id;
        $admin->mobile_number = $mobile;
        $admin->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Update Admin Profile');


        return redirect()->route('admin.profile');
    }


    // method use to view change password form
    public function changePassword()
    {
        return view('admin.change-password');
    }


    // method use to change password
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
        if(password_verify($old, Auth::guard('admin')->user()->password)) {
            // change the password
            $admin = Admin::findorfail(Auth::guard('admin')->user()->id);
            $admin->password = bcrypt($new);
            $admin->save();

            // activity log
            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Change Password');

            return redirect()->route('admin.change.password')->with('success', 'Password Changed!');
        }

        return redirect()->route('admin.change.password')->with('error', 'Old Password Invalid!');
    }


    // method use to show activity logs
    public function activityLog()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('admin.activity-log', ['logs' => $logs]);
    }


    // method use to view cashiers
    public function viewCashiers()
    {
        // get all cashiers
        $cashiers = Cashier::orderBy('lastname', 'asc')
                        ->paginate(15);

        return view('admin.cashiers', ['cashiers' => $cashiers]);
    }


    // method use to reset cashier password to default
    public function postResetCashierPassword(Request $request)
    {
        $id = $request['id'];

        $cashier = Cashier::findorfail($id);
        $cashier->password = bcrypt('cashier');
        $cashier->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Reset Cashier Password: ' . $cashier->firstname . ' ' . $cashier->lastname);

        return redirect()->route('admin.view.cashiers')->with('success', 'Reset to default password. Success!');

    }


    // method use to view add cashier form
    public function addCashier()
    {
        return view('admin.add-cashier');
    }


    // method use to add cashier
    public function postAddCashier(Request $request)
    {

        // validate form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'id_number' => 'required|unique:cashiers',
            'mobile_number' => 'required|unique:cashiers'
        ]);


        // assign form data to variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $username = $request['username'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];


        // check


        // save cashier
        $cashier = new Cashier();
        $cashier->username = $username;
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->id_number = $id;
        $cashier->mobile_number = $mobile;
        $cashier->password = bcrypt('cashier');
        $cashier->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Cashier Account');

        // return data with message
        return redirect()->route('admin.add.cashier');

    }


    // method use to view registrars
    public function viewRegistrars()
    {
        $registrars = Registrar::orderBy('lastname', 'asc')
                            ->paginate(15);

        return view('admin.registrars', ['registrars' => $registrars]);
    }


    // method use to reset registrar password to default
    public function postResetRegistrarPassword(Request $request)
    {
        $id = $request['id'];

        $registrar = Registrar::findorfail($id);
        $registrar->password = bcrypt('registrar');
        $registrar->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Reset Registrar Password: ' . $registrar->firstname . ' ' . $registrar->lastname);

        return redirect()->route('admin.view.registrars')->with('success', 'Reset to default password. Success!');

    }


    // method use to view add form of registrar
    public function addRegistrar()
    {
        return view('admin.add-registrar');
    }


    // method use to save new registrar
    public function postAddRegistrar(Request $request)
    {

        // validate form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'id_number' => 'required|unique:cashiers',
            'mobile_number' => 'required|unique:cashiers'
        ]);


        // assign form data to variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $username = $request['username'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];


        // check


        // save cashier
        $cashier = new Registrar();
        $cashier->username = $username;
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->id_number = $id;
        $cashier->mobile_number = $mobile;
        $cashier->password = bcrypt('registrar');
        $cashier->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Registrar Account');

        // return data with message
        return redirect()->route('admin.add.registrar');

    }


    // method use to view programs available 
    public function viewPrograms()
    {
        // get all programs offered
        $programs = Program::orderBy('title', 'asc')
                        ->paginate(5);

        return view('admin.programs', ['programs' => $programs]);
    }


    // method use to view add program form
    public function addProgram()
    {
        return view('admin.add-program');
    }

}
