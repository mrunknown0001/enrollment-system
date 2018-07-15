<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\User;
use App\StudentInfo;
use App\Course;
use App\Program;
use App\YearLevel;
use App\Assessment;
use App\MiscFee;
use App\Payment;
use App\Subject;
use App\PricePerUnit;
use App\AcademicYear;
use App\ActiveSemester;
use App\EnrollmentSetting;
use App\Grade;

use App\Http\Controllers\GeneralController;

class StudentController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');

    }


    private function check_enrollment_setting()
    {
        $es = EnrollmentSetting::findorfail(1);

        $status = false;

        if($es->status == 1) {
            $status = true;
        }
        else {
            $status = false;
        }

        return $status;
    }


    // method to show the dashboard of student
    public function dashboard()
    {
    	// check if program and couse are active
        $courses = Course::where('active', 1)->get(['id', 'active']);
        $programs = Program::where('active', 1)->get(['id', 'active']);
        $yl = YearLevel::where('active', 1)->first();

        $es = $this->check_enrollment_setting();

        // get all the data need to show in dashboard of student

        return view('student.dashboard', ['courses' => $courses, 'programs' => $programs, 'yl' => $yl, 'es' => $es]);
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
        $last_attended = $request['school_last_attended'];
        $date_graduated = $request['year_graduated'];
        // check


        // register/save the information of the student
        $user = User::findorfail(Auth::user()->id);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->mobile_number = $mobile;
        $user->save();

        $info = StudentInfo::findorfail(Auth::user()->info->id);
        $info->date_of_birth = date('Y-m-d', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->address = $address;
        $info->nationality = $nationality;
        $info->school_last_attended = $last_attended;
        $info->date_graduated = $date_graduated;
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
        if($this->check_enrollment_setting() == false) {
            return redirect()->back()->with('error', 'Enrollment Not Active!');
        }

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


    // method use to view Grades
    public function viewGrades()
    {

        // get all subjects enrolled 
        $assessment = Assessment::where('student_id', Auth::user()->id)
                                ->where('paid', 1)
                                ->where('active', 1)
                                ->first();
        $subjects = null;
        if(count($assessment) > 0) {
            foreach(unserialize($assessment->subject_ids) as $id) {
                $subjects = Subject::find($id);
            }
        }

        return view('student.grades', ['subjects' => $subjects]);
    }

    // method use to view grades of subject
    public function viewSubjectGrades($id = null)
    {
        $subject = Subject::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $grades = Grade::where('student_id', Auth::user()->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('subject_id', $subject->id)
                    ->get();

        return view('student.grades-view', ['subject' => $subject, 'ay' => $ay, 'sem' => $sem, 'grades' => $grades]);
    }


    // method use to view remarks
    public function viewRemarks()
    {
        return view('student.remarks');
    }


    // method use to view subjects
    public function viewSubjects()
    {
        $assessment = Assessment::where('student_id', Auth::user()->id)
                                ->where('paid', 1)
                                ->where('active', 1)
                                ->first();
        $subjects = null;
        if(count($assessment) > 0) {
            foreach(unserialize($assessment->subject_ids) as $id) {
                $subjects = Subject::find($id);
            }
        }

        return view('student.subjects', ['subjects' => $subjects]);
    }


    // method use to view program enrolled
    public function viewProgram()
    {
        $assessment = Assessment::where('student_id', Auth::user()->id)
                                ->where('paid', 1)
                                ->where('active', 1)
                                ->first();

        $program = null;

        if(count($assessment) > 0) {
            $program = Program::find($assessment->program_id);
        }

        return view('student.programs', ['program' => $program]);
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

        $yl = 0;
        $subjects = [];
        $program = null;

        // check what to enroll and other components 
        if(Auth::user()->info->enrolling_for == 1) {
            // for course
            // get all the available course
            // get the year level active for enrollment
            $enroll = Course::where('active', 1)->get();
            $yl = YearLevel::where('active', 1)->first();

            // additional condition for irregular students
            $subjects = Subject::where('active', 1)
                        ->where('year_level', $yl->id)
                        ->get();

        }
        else {
            // for program
            // get all program available

            $enroll = Program::where('active', 1)->get();
        }

        return view('student.enroll', ['enroll' => $enroll, 'yl' => $yl, 'subjects' => $subjects]);
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

        $assessement_number = GeneralController::generate_assessment_number();

        Auth::user()->info->program_id = $program_id;
        Auth::user()->info->save();


        // save to assessment
        $assess = new Assessment();
        $assess->student_id = Auth::user()->id;
        $assess->assessment_number = $assessement_number;
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


    // method use to save course in info
    public function postEnrollCourse(Request $request)
    {
        $request->validate([
            'course' => 'required'
        ]);

        $course_id = $request['course'];

        // save 
        Auth::user()->info->course_id = $course_id;
        Auth::user()->info->save();
        
        // activity log
        GeneralController::activity_log(Auth::user()->id, 5, 'Student Selected Course');

        // return
        return redirect()->route('student.enroll');
    }


    // method use to save subject in assessment
    public function postEnrollCourseSubject(Request $request)
    {
        $request->validate([
            'subjects' => 'required'
        ]);

        $subject_ids[] = $request['subjects'];
        $units = 0;

        $unit_price = PricePerUnit::find(1);
        $ay = AcademicYear::where('active', 1)->first();
        $semester = ActiveSemester::where('active', 1)->first();

        // get all subjects
        foreach($subject_ids as $id) {
            $subjects = Subject::find($id);
        }

        // count units
        foreach($subjects as $s) {
            $units += $s->units;
        }

        // total amount units
        $subject_amount = $units * $unit_price->price;

        // compute the misc
        $misc_fee = MiscFee::where('type', 1)->orwhere('type', 3)->get();

        $misc = 0;

        foreach($misc_fee as $m) {
            $misc += $m->amount;
        }
        

        // compute total
        $total = $misc + $subject_amount;

        $assessement_number = GeneralController::generate_assessment_number();

        // save to assessment
        $assess = new Assessment();
        $assess->student_id = Auth::user()->id;
        $assess->course_id = Auth::user()->info->course_id;
        $assess->assessment_number = $assessement_number;
        $assess->subject_ids = serialize($subject_ids);
        $assess->semester_id = $semester->id;
        $assess->academic_year_id = $ay->id;
        $assess->tuition_fee = $subject_amount;
        $assess->misc_fee = $misc;
        $assess->total = $total;
        $assess->year_level_id = Auth::user()->info->year_level;
        $assess->save();

        // add actvitiy log
        GeneralController::activity_log(Auth::user()->id, 5, 'Student Selected Subject');

        // return
        return redirect()->route('student.enroll');
    }


    // method use to view
    public function viewAssessment()
    {
        $assessment = Assessment::where('student_id', Auth::user()->id)->where('active', 1)->first();

        $subjects = null;

        if(count($assessment) > 0) {
            if($assessment->subject_ids != null) {
                $subject_ids = unserialize($assessment->subject_ids);

                // get all subjects
                foreach($subject_ids as $s) {
                    $subjects = Subject::find($s);
                }
            }
        }

        return view('student.assessment', ['assessment' => $assessment, 'subjects' => $subjects]);
    }


    // method use to view payments
    public function viewPayments()
    {
        $payments = Payment::where('student_id', Auth::user()->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        return view('student.payments', ['payments' => $payments]);
    }


}
