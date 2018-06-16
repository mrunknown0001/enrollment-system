<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IdReference;

class GeneralController extends Controller
{
    
    ////////////////////////////////////////////////////////////////////////////
    // static method use to generate and check student number in the database //
    ////////////////////////////////////////////////////////////////////////////
    public static function generate_student_number()
    {
    	// check the year month and the last number produced
        $ref = IdReference::findorfail(1);

    	// check if the month and year is current
        $year = date('Y');
        $month = date('m');



    	// generate the next student number


    	// check if the student number generated is present in the database
        
        return $ref->year . ' ' . $ref->month . ' ' . $ref->last; 


    }



    ////////////////////////////////
    // activity log for all users //
    ////////////////////////////////
    public static function activity_log($id = null, $user_type = null, $action = null)
    {
    	// 
    }

}
