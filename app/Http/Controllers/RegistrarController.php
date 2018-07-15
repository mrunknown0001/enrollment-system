<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\GeneralController;
use DB;

use App\Registrar;
use App\Course;
use App\Program;
use App\YearLevel;
use App\StudentInfo;
use App\User;
use App\AcademicYear;
use App\Remark;
use App\ActiveSemester;
use App\Assessment;
use App\Subject;
use App\Grade;

class RegistrarController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:registrar');
    }

    // method use to view registrar dashboard
    public function dashboard()
    {
    	return view('registrar.dashboard');
    }


    // method use to view profile of registrar
    public function profile()
    {
    	return view('registrar.profile');
    }

    // method use to view profiel update of registrar
    public function updateProfile()
    {
    	return view('registrar.profile-update');
    }


    // method use to update registrar profile
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

        $registrar = Registrar::findorfail(Auth::guard('registrar')->user()->id);
        $registrar->firstname = $firstname;
        $registrar->lastname = $lastname;
        $registrar->id_number = $id;
        $registrar->mobile_number = $mobile;
        $registrar->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Update Registrar Profile');

        // return message
        return redirect()->route('registrar.profile')->with('success', 'Profile Updated!');
    }


    // method use to view password change form
    public function changePassword()
    {
    	return view('registrar.change-password');
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
        if(password_verify($old, Auth::guard('registrar')->user()->password)) {
            // change the password
            $registrar = Registrar::findorfail(Auth::guard('registrar')->user()->id);
            $registrar->password = bcrypt($new);
            $registrar->save();

            // activity log
            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Registrar Change Password');

            return redirect()->route('registrar.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('registrar.password.change')->with('error', 'Old Password Invalid!');
    }


    // method use to view students
    public function viewStudents()
    {
        // get all students currently enrolled
        
        return view('registrar.students');
    }


    // method use to view courses
    public function viewCourses()
    {   
        $courses = Course::orderBy('title', 'asc')
                            ->get();

        return view('registrar.courses', ['courses' => $courses]);
    }


    // method use to view course year level
    public function viewCourseYearLevel($id = null)
    {
        $course = Course::findorfail($id);
        $yl = YearLevel::get();

        return view('registrar.course-year-level', ['course' => $course, 'yl' => $yl]);
    }


    // method to view enrolled in yearl level of the course
    public function viewCourseYearLevelEnrolled($course_id = null, $yl_id = null)
    {
        $course = Course::findorfail($course_id);
        $yl = YearLevel::findorfail($yl_id);


        // find all enrolled students in the course with the year level
        // $students = StudentInfo::where('course_id', $course->id)
        //                         ->where('year_level', $yl->id)
        //                         ->where('graduated', 0)
        //                         ->get();

        $students = DB::table('users')
                    ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                    ->where('student_infos.course_id', $course->id)
                    ->where('student_infos.year_level', $yl->id)
                    ->where('student_infos.graduated', 0)
                    ->orderBy('lastname', 'asc')
                    ->get();

        return view('registrar.course-year-level-students', ['course' => $course, 'yl' => $yl, 'students' => $students]);
    }


    // route to view grades of enrolled in a course
    public function viewCourseStudentGrades($id = null, $sid = null)
    {
        $course = Course::findorfail($id);
        $student = User::findorfail($sid);
        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // get the assessment
        $assessment = Assessment::where('student_id', $student->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->where('paid', 1)
                            ->where('active', 1)
                            ->first();
        
        $subject_ids = unserialize($assessment->subject_ids);

        $subjects = Subject::find($subject_ids);

        // get the grades of each subject
        $grades = null;

        foreach($subjects as $sub) {
            $grades[] = Grade::where('student_id', $student->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->where('subject_id', $sub->id)
                            ->get();
        }

        return view('registrar.student-grades', ['course' => $course, 'student' => $student, 'ay' => $ay, 'sem' => $sem, 'grades' => $grades, 'subjects' => $subjects]);
    }


    // method use to view programs
    public function viewPrograms()
    {
        $programs = Program::orderBy('title', 'asc')
                            ->get();

        return view('registrar.programs', ['programs' => $programs]);
    }


    // method use to view program enrolled students
    public function viewProgramEnrolled($id = null)
    {
        $program = Program::findorfail($id);

        $students = DB::table('users')
                    ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                    ->where('student_infos.program_id', $program->id)
                    ->where('student_infos.graduated', 0)
                    ->orderBy('lastname', 'asc')
                    ->get();

        return view('registrar.program-students', ['program' => $program, 'students' => $students]);
    }


    // method use to view student remarks in a program
    public function viewStudentProgramRemarks($id = null, $pid = null)
    {
        $student = User::findorfail($id);
        $program = Program::findorfail($pid);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $remarks = Remark::where('student_id', $student->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('program_id', $program->id)
                    ->first();

        return view('registrar.student-program-remarks', ['student' => $student, 'program' => $program, 'ay' => $ay, 'sem' => $sem, 'remark' => $remarks]);
    }


    // method use to view details of students
    public function viewStudentDetails($id = null, $sn = null)
    {
        $student = User::findorfail($id);

        if($student->student_number != $sn) {
            return abort(400);
        }

        return view('registrar.student-details', ['student' => $student]);
    }


    // method use to search students
    public function searchStudent(Request $request)
    {
        $keyword = $request['keyword'];

        $students = GeneralController::students_search($keyword);

        return view('registrar.students-search', ['students' => $students, 'keyword' => $keyword]);
    }

}
