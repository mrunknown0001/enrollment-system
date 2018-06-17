<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IdReference;
use App\User;
use App\ActivityLog;

class GeneralController extends Controller
{
    
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
