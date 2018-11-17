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
use App\ActiveSemester;
use App\AcademicYear;
use App\Grade;
use App\FinalGrade;
use App\Subject;
use App\UserPasswordReset;

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
        $number = 'P' . mt_rand(000000, 999999) . uniqid(); // better than rand()

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
        $students = User::where('active', 1)
                        ->where('firstname', "like", "%$keyword%")
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


    ///////////////////////////////////////
    // method use to get name of the day //
    ///////////////////////////////////////
    public static function get_day($day)
    {
        switch ($day) {
            case 1:
                $name = 'Monday';
                break;
            
            case 2:
                $name = 'Tuesday';
                break;
            
            case 3:
                $name = 'Wednesday';
                break;
            
            case 4:
                $name = 'Thursday';
                break;
            
            case 5:
                $name = 'Friday';
                break;
            
            case 6:
                $name = 'Saturday';
                break;
            
            case 7:
                $name = 'Sunday';
                break;
            
            default:
                $name = 'Not Found';
                break;
        }

        return $name;
    }


    ////////////////////////////
    // method use to get time //
    ////////////////////////////
    public static function get_time($time)
    {
        switch ($time) {
            case 1:
                $t = '6:00 am';
                break;
            
            case 2:
                $t = '6:30 am';
                break;
            
            case 3:
                $t = '7:00 am';
                break;
            
            case 4:
                $t = '7:30 am';
                break;
            
            case 5:
                $t = '8:00 am';
                break;
            
            case 6:
                $t = '8:30 am';
                break;
            
            case 7:
                $t = '9:00 am';
                break;
            
            case 8:
                $t = '9:30 am';
                break;
            
            case 9:
                $t = '10:00 am';
                break;
            
            case 10:
                $t = '10:30 am';
                break;
            
            case 11:
                $t = '11:00 am';
                break;
            
            case 12:
                $t = '11:30 am';
                break;
            
            case 13:
                $t = '12:00 pm';
                break;
            
            case 14:
                $t = '12:30 pm';
                break;
            
            case 15:
                $t = '1:00 pm';
                break;
            
            case 16:
                $t = '1:30 pm';
                break;
            
            case 17:
                $t = '2:00 pm';
                break;
            
            case 18:
                $t = '2:30 pm';
                break;
            
            case 19:
                $t = '3:00 pm';
                break;
            
            case 20:
                $t = '3:30 pm';
                break;
            
            case 21:
                $t = '4:00 pm';
                break;
            
            case 22:
                $t = '4:30 pm';
                break;
            
            case 23:
                $t = '5:00 pm';
                break;
            
            case 24:
                $t = '5:30 pm';
                break;
            
            case 25:
                $t = '6:00 pm';
                break;
            
            case 26:
                $t = '6:30 pm';
                break;
            
            case 27:
                $t = '7:00 pm';
                break;
            
            case 28:
                $t = '7:30 pm';
                break;
            
            case 29:
                $t = '8:00 pm';
                break;
            
            case 30:
                $t = '8:30 pm';
                break;
            
            case 31:
                $t = '9:00 pm';
                break;
            
            case 32:
                $t = '9:30 pm';
                break;
            
            case 33:
                $t = '10:00 pm';
                break;
            
            case 34:
                $t = '10:30 pm';
                break;

            default:
                $t = 'Time Not Found!';
                break;
        }

        return $t;
    }


    ///////////////////////////////////////////////////////////////////
    // method use to determine a student to move to next year level  //
    ///////////////////////////////////////////////////////////////////
    public static function move_next_yl($id)
    {
        $student = User::findorfail($id);

        // check if all subject for current year level is passed in final grades
        // to determine if the student can move to next year level

        return true;

    }


    //////////////////////////////////////////
    // method use to make student graduated //
    //////////////////////////////////////////
    public static function graduated($id)
    {
        $student = User::findorfail($id);

        // check if all subjects in the curriculum has passed
        // to be able to graduate

        return true;
    }


    ////////////////////////////////////////////////////////
    // method use to save all enrolled subject of student //
    ////////////////////////////////////////////////////////
    public static function save_final_grades($sid)
    {
        $student = User::find($sid);
        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // get active assessment for student
        $assessment = Assessment::where('student_id', $student->id)
                                ->where('paid', 1)
                                ->where('active', 1)
                                ->first();

        $subjects = null;
        if(count($assessment) > 0) {
            foreach(unserialize($assessment->subject_ids) as $id) {
                $subjects = Subject::find($id);
            }
        }


        $grades = null;

        foreach($subjects as $sub) {
            $grades[] = Grade::where('student_id', $student->id)
                ->where('academic_year_id', $ay->id)
                ->where('semester_id', $sem->id)
                ->where('subject_id', $sub->id)
                ->get();
        }

        // get the equivalent of the grades
        $equiv = null;
        $total = 0;

        foreach($subjects as $sub) {
            $total = 0;
            foreach($grades as $gr) {

                if(count($gr) > 0) {
                    foreach($gr as $g) {
                        if($sub->id == $g->subject_id) {
                            $total += $g->grade;
                        }
                    }
                }

            }

            // get the average and its equivalent
            $average = $total/4;

            // find its equivalent
            $equivalent = GeneralController::equivalent($average);

            $desc = 'Failed';

            if($equivalent->equivalent <= 3) {
                $desc = 'Passed';
            }

            // save to final grade
            $fg = new FinalGrade();
            $fg->student_id = $student->id;
            $fg->academic_year_id = $ay->id;
            $fg->semester_id = $sem->id;
            $fg->subject_id = $sub->id;
            $fg->grade = $equivalent->equivalent;
            $fg->description = $desc;
            $fg->save();
        }

    }

    // method use to generate unique reset code
    public static function generate_reset_code()
    {
        $code = mt_rand(000000, 999999);

        if(UserPasswordReset::whereCode($code)->exists()) {
            return self::generate_reset_code();
        }

        return $code;
    }


}
