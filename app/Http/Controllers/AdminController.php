<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Cashier;
use App\ActivityLog;
use App\Registrar;

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

        return view('admin.programs');
    }

}
