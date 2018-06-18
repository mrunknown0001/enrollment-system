<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\IdReference;
use App\User;
use App\ActivityLog;

class GeneralController extends Controller
{

    //////////////////////////////////
    // session logout for all users //
    //////////////////////////////////
    public function logout()
    {
        // check if there is authenticted user
        if(Auth::check()) {
            // add activity log
            GeneralController::activity_log(Auth::user()->id, 5, 'Student Logout');

            Auth::logout();
        }
        elseif (Auth::guard('faculty')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 4, 'Faculty Logout');

            Auth::guard('faculty')->logout();
        }
        elseif(Auth::guard('admin')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Logout');

            Auth::guard('admin')->logout();
        }
        elseif(Auth::guard('cashier')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Cashier Logout');

            Auth::guard('cashier')->logout();
        }
        elseif(Auth::guard('registrar')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 2, 'Cashier Logout');

            Auth::guard('registrar')->logout();
        }
        
        return redirect()->route('welcome');
        
    }



    //////////////////////////////
    // auth check for all users //
    //////////////////////////////
    public static function auth_check($view)
    {
        // check the user and redirect to intented dashboard
        // check if there is authenticted user
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

        return view($view);


    }
    

    
    ////////////////////////////////////////////////////////////////////////////
    // static method use to generate and check student number in the database //
    ////////////////////////////////////////////////////////////////////////////
    public static function generate_student_number()
    {
    	// check the year month and the last number produced
        $ref = IdReference::findorfail(1);
        $y = $ref->year;
        $m = $ref->month;
        $last = $ref->last + 1;

    	// check if the month and year is current
        $year = date('Y');
        $month = date('m');

        // check if the year is current or new
        if($year > $ref->year) {
            $y = $year;
        }

        if($month > $ref->month) {
            $m = $month;
            $last = 1;
        }

    	// generate the next student number
        $number = $y . $m . str_pad($last,4,"0",STR_PAD_LEFT);

    	// check if the student number generated is present in the database
        if(User::whereStudentNumber($number)->exists()) {
            return self::generate_student_number();
        }

        // if all ok save the last reference in the table
        $ref->year = $y;
        $ref->month = $m;
        $ref->last = $last;
        $ref->save();

        return $number;

    }



    ////////////////////////////////
    // activity log for all users //
    ////////////////////////////////
    public static function activity_log($id = null, $user_type = null, $action = null)
    {
    	$log = new ActivityLog();
        $log->user_id = $id;
        $log->user_type = $user_type;
        $log->action = $action;
        $log->save();
    }

}
