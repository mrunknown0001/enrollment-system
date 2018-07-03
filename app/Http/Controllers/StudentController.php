<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\StudentInfo;
use App\Course;
use App\Program;
use App\YearLevel;
use App\Assessment;
use App\MiscFee;
use App\Payment;

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
    	// check if program and couse are active
        $courses = Course::where('active', 1)->get(['id', 'active']);
        $programs = Program::where('active', 1)->get(['id', 'active']);
        $yl = YearLevel::where('active', 1)->first();

        // get all the data need to show in dashboard of student


        return view('student.dashboard', ['courses' => $courses, 'programs' => $programs, 'yl' => $yl]);
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


    // method use to save enrollment for
    public function postEnrollmentFor(Request $request)
    {
        $request->validate([
            'enrolling_for' => 'required'
        ]);

        $enroll = $request['enrolling_for'];

        $student = User::find(Auth::user()->id);

        $student->info->enrolling_for = $enroll;
        $student->info->save();

        GeneralController::activity_log(Auth::user()->id, 5, 'Student going to enroll');

        return redirect()->route('student.dashboard')->with('Set For Enrollment!');

    }


    // method to save selected year level
    public function postYearLevel(Request $request)
    {
        $request->validate([
            'year_level' => 'required'
        ]);

        $yl = $request['year_level'];

        $student = User::find(Auth::user()->id);

        $student->info->year_level = $yl;
        $student->info->save();

        GeneralController::activity_log(Auth::user()->id, 5, 'Student Added Year Level');

        return redirect()->route('student.dashboard')->with('Year Level Added!');
    }


    // method use to view subjects
    public function viewSubjects()
    {
        return view('student.subjects');
    }


    // method use to view program enrolled
    public function viewProgram()
    {
        return view('student.programs');
    }


    // method use to view enrollment settings
    public function viewEnroll()
    {
        $courses = Course::where('active', 1)->get();
        $programs = Program::where('active', 1)->get();

        if(count($courses) < 1 && count($programs) < 1) {
            return redirect()->route('student.dashboard');
        }

        if(Auth::user()->info->enrolling_for == null) {
            return redirect()->route('student.dashboard');
        }

        if(Auth::user()->info->enrolling_for == 1 && Auth::user()->info->year_level == null) {
            return redirect()->route('student.dashboard');
        }


        // check what to enroll and other components 
        if(Auth::user()->info->enrolling_for == 1) {
            // for course
            // get all the available course
            // get the year level active for enrollment

        }
        else {
            // for program
            // get all program available
            $enroll = Program::where('active', 1)->get();
        }

        return view('student.enroll', ['enroll' => $enroll]);
    }


    // method use to save enroll assessement in program
    public function postEnrollProgram(Request $request)
    {
        $request->validate([
            'program' => 'required'
        ]);

        $program_id = $request['program'];

        $program = Program::findorfail($program_id);

        
        // compute the amount of total payable
        $misc_fee = MiscFee::where('type', 2)->orwhere('type', 3)->get();

        $misc = 0;

        foreach($misc_fee as $m) {
            $misc += $m->amount;
        }

        $total = $misc + $program->tuition_fee;


        // save to assessment
        $assess = new Assessment();
        $assess->student_id = Auth::user()->id;
        $assess->program_id = $program_id;
        $assess->tuition_fee = $program->tuition_fee;
        $assess->misc_fee = $misc;
        $assess->total = $total;
        $assess->save();

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 5, 'Student enrolled to a Program');

        // return to assessment with message
        return redirect()->route('student.assessment')->with('sucess', 'Assessment Saved for the chosen Program!');
    }


    // method use to view
    public function viewAssessment()
    {
        $assessment = Assessment::where('student_id', Auth::user()->id)->where('active', 1)->first();

        return view('student.assessment', ['assessment' => $assessment]);
    }


    // method use to view payments
    public function viewPayments()
    {
        $payments = Payment::where('student_id')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        return view('student.payments', ['payments' => $payments]);
    }


}
