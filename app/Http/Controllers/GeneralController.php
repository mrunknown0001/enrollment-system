<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\IdReference;
use App\User;
use App\ActivityLog;
use App\Assessment;
use App\GradeEquivalent;

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



    /////////////////////////////////////////////////////////
    // method to create unique assessment reference number //
    /////////////////////////////////////////////////////////
    public static function generate_assessment_number()
    {
        $number = 'P-' . mt_rand(000000, 999999) . uniqid(); // better than rand()

        // call the same function if the barcode exists already
        if (Assessment::whereAssessmentNumber($number)->exists()) {
            return self::generate_assessment_number();
        }

        // otherwise, it's valid and can be used
        return  strtoupper($number);
    }



    /////////////////////////////////////////////////////////////////////
    // method use to search students in users and student_infos tables //
    /////////////////////////////////////////////////////////////////////
    public static function students_search($keyword = null)
    {
        $students = User::where('firstname', "like", "%$keyword%")
                        ->orwhere('lastname', "like", "%$keyword%")
                        ->orwhere('student_number', "like", "%$keyword%")
                        ->orderBy('lastname', 'asc')
                        ->paginate(10);
                        
        return $students;
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


    /////////////////////////
    // find the equivalent //
    /////////////////////////
    public static function equivalent($ave = null)
    {
        $e = 5.00;

        if($ave != 0) {

            switch ($ave) {

                case $ave >= 99.00 && $ave == 100:
                    $e = 1.00;
                    break;
                
                case $ave <= 98.99 && $ave >= 95.00:
                    $e = 1.25;
                    break;

                case $ave <= 94.99 && $ave >= 92.00:
                    $e = 1.50;
                    break;

                case $ave <= 91.99 && $ave >= 89.00:
                    $e = 1.75;
                    break;

                case $ave <= 88.99 && $ave >= 86.00:
                    $e = 2.00;
                    break;

                case $ave <= 85.99 && $ave >= 83.00:
                    $e = 2.25;
                    break;

                case $ave <= 82.99 && $ave >= 80.00:
                    $e = 2.50;
                    break;

                case $ave <= 79.99 && $ave >= 77.00:
                    $e = 2.75;
                    break;

                case $ave <= 76.99 && $ave >= 75.00:
                    $e = 3.00;
                    break;

                case $ave < 74.99:
                    $e = 5.00;
                    break;

                default:
                    $e = 5.00;
                    break;
            }

        }


        $eq = GradeEquivalent::where('equivalent', $e)->first();

        return $eq;
    }
}
