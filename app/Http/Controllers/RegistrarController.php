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
use App\FinalGrade;

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
                    ->where('student_infos.enrolled', 1)
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


    // method use to update student grades in a subject
    public function updateStudentSubjectGrades($id = null, $student_id = null, $subject_id = null)
    {
        $course = Course::findorfail($id);
        $student = User::findorfail($student_id);
        $subject = Subject::findorfail($subject_id);

        $ay = ActiveSemester::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // get the grades for display
        $grades = Grade::where('student_id', $student->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('subject_id', $subject->id)
                    ->get();

        return view('registrar.subject-student-grade-update', [ 
            'course' => $course,
            'student' => $student,
            'subject' => $subject,
            'grades' => $grades,
            'ay' => $ay,
            'sem' => $sem
        ]);
    }


    // method use to save update changes in grades of student in a subject
    public function postUpdateStudentSubjectGrades(Request $request)
    {
        $request->validate([
            'prelim' => 'required|numeric',
            'midterm' => 'required|numeric',
            'semi_final' => 'required|numeric',
            'final' => 'required|numeric'
        ]);

        $subject_id = $request['subject_id'];
        $student_id = $request['student_id'];
        $course_id = $request['course_id'];

        $prelim = $request['prelim'];
        $midterm = $request['midterm'];
        $semi_final = $request['semi_final'];
        $final = $request['final'];

        $subject = Subject::find($subject_id);
        $student = User::find($student_id);
        $course = Course::find($course_id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // get all the grades
        $grades = null;

        $grades = Grade::where('student_id', $student->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('subject_id', $subject->id)
                    ->get();

        // update grades
        foreach($grades as $g) {
            if($g->term_id == 1) {
                $g_u = Grade::find($g->id);
                $g_u->grade = $prelim;
                $g_u->save();
            }
            if($g->term_id == 2) {
                $g_u = Grade::find($g->id);
                $g_u->grade = $midterm;
                $g_u->save();
            }
            if($g->term_id == 3) {
                $g_u = Grade::find($g->id);
                $g_u->grade = $semi_final;
                $g_u->save();
            }
            if($g->term_id == 4) {
                $g_u = Grade::find($g->id);
                $g_u->grade = $final;
                $g_u->save();
            }
        }

        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Registrar Updated Grade');

        // return with success
        return redirect()->route('registrar.view.course.student.grades', ['id' => $course->id, 'sid' => $student->id])->with('success', 'Student Subject Grade Updated');
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
                    ->where('student_infos.enrolled', 1)
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


    // method use to update student remarks
    public function updateStudentProgramRemarksUpdate($id = null, $pid = null)
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

        // return to view for update
        return view('registrar.student-program-remark-update', ['student' => $student, 'program' => $program, 'ay' => $ay, 'sem' => $sem, 'remarks' => $remarks]);

    }


    // method use to save update in program remarks
    public function postUpdateStudentProgramRemarksUpdate(Request $request)
    {
        $request->validate([
            'remark' => 'required'
        ]);

        $student_id = $request['student_id'];
        $program_id = $request['program_id'];

        $remark = $request['remark'];

        $program = Program::findorfail($program_id);
        $student = User::findorfail($student_id);
        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $rem = Remark::where('student_id', $student->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('program_id', $program->id)
                    ->first();

        $rem->remarks = $remark;
        $rem->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Registrar Remarks Updated');

        // return to remarks in program
        return redirect()->route('registrar.view.program.enrolled', ['id' => $program->id])->with('success', 'Remark Updated!');
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


    // method use to view grades in student
    public function viewStudentGrades($id = null, $sn = null)
    {
        $student = User::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $course = Course::find($student->info->course_id);

        if($student->student_number != $sn) {
            return redirect()->back()->with('error', 'Error Occured! Please go to dashboard');
        }

        // get all grades available
        $grades = Grade::where('student_id', $student->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->get();

        $assessment = Assessment::where('student_id', $student->id)
                            ->where('active', 1)
                            ->first();
        $subjects = null;
        $subject_ids = unserialize($assessment->subject_ids);

        foreach($subject_ids as $id) {
            $subjects = Subject::find($id);
        }



        return view('registrar.student-view-grades', [
            'student' => $student,
            'grades' => $grades,
            'subjects' => $subjects,
            'course' => $course,
            'ay' => $ay,
            'sem' => $sem
        ]);
    }


    // method use to view student tor
    public function viewStudentTor($id = null, $sn = null)
    {
        $student = User::findorfail($id);

        // check if sn is correct
        if($student->student_number != $sn) {
            return redirect()->back()->with('error', 'Modification Detected!');
        }

        // get course
        $course = Course::find($student->info->course_id);

        // get all grades
        $grades = Grade::where('student_id', $student->id)->get();

        // get all subjects
        $subjects = Subject::get();
        
        // find grades per subject eqivalent
        $equiv = null;
        $total = 0;
        $yl = null;
        $sem = null;
        $ay = null;

        foreach($subjects as $sub) {
            $total = 0;
            foreach($grades as $g) {

                if($sub->id == $g->subject_id) {
                    $total += $g->grade;
                }
                $yl = $g->year_level_id;
                $sem = $g->semester_id;
                $ac = $g->academic_year_id;                   

            }

            // get the average and its equivalent
            $average = $total/4;

            // find its equivalent
            $equivalent = GeneralController::equivalent($average);

            if($equiv == null) {
                $equiv = array([
                    'subject_id' => $sub->id,
                    'equivalent' => $equivalent->equivalent,
                    'description' => $equivalent->description,
                    'academic_year_id' => $ay,
                    'semester_id' => $sem,
                    'year_level_id' => $yl
                ]);
            }
            else {
                array_push($equiv, [
                    'subject_id' => $sub->id,
                    'equivalent' => $equivalent->equivalent,
                    'description' => $equivalent->description,
                    'academic_year_id' => $ay,
                    'semester_id' => $sem,
                    'year_level_id' => $yl
                ]);
            }
        }


        // return with ay, sem, subject details and equivalent
        return view('registrar.student-view-tor', ['student' => $student, 'course' => $course, 'equiv' => $equiv, 'subjects' => $subjects]);
    }


    // method use to view remarks in stuent
    public function viewStudentRemarks($id = null, $sn = null)
    {
        $student = User::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $program = Program::find($student->info->program_id);

        if($student->student_number != $sn) {
            return redirect()->back()->with('error', 'Error Occured! Please go to dashboard');
        }

        // get the remarks
        $remarks = Remark::where('academic_year_id', $ay->id)
                        ->where('student_id', $student->id)
                        ->where('semester_id', $sem->id)
                        ->where('program_id', $program->id)
                        ->first();

        return view('registrar.student-view-remarks', ['student' => $student, 'ay' => $ay, 'sem' => $sem, 'program' => $program, 'remarks' => $remarks]);
    }


    // method use to search students
    public function searchStudent(Request $request)
    {
        $keyword = $request['keyword'];

        $students = GeneralController::students_search($keyword);

        return view('registrar.students-search', ['students' => $students, 'keyword' => $keyword]);
    }


    // method use to add credit to student
    public function studentAddCredits($id = null)
    {
        $student = User::findorfail($id);

        if($student->info->enrolling_for != 1) {
            return redirect()->back()->with('error', 'Student Not Enrolled in Course!');
        }

        // get subjects that has not in final grades
        // get all subjects
        // get all subjects
        // get subject without grades only
        $subjects = [];
        $subjects_all = Subject::get(['id', 'code']);

        $subjects_grades = FinalGrade::where('student_id', $student->id)->get(['subject_id']);

        if(count($subjects_grades) > 0) {
            foreach($subjects_all as $s_a) {
                foreach($subjects_grades as $s_g) {
                    if($s_a->id != $s_g->subject_id) {
                        array_push($subjects, [
                            'id' => $s_a->id,
                            'code' => $s_a->code
                        ]);
                    }
                }
            }
        }
        else {
            foreach($subjects_all as $s_a) {
                array_push($subjects, [
                    'id' => $s_a->id,
                    'code' => $s_a->code
                ]);
            }
        }

        // return $subjects;

        return view('registrar.student-credit-add', ['student' => $student, 'subjects' => $subjects]);
    }


    // method use to save credits to student
    public function postStudentAddCredits(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'grade' => 'required'
        ]);

        $subject_id = $request['subject'];
        $grade = $request['grade'];
        $student_id = $request['student_id'];

        $student = User::findorfail($student_id);
        $subject = Subject::findorfail($subject_id);

        $g = new FinalGrade();
        $g->student_id = $student->id;
        $g->subject_id = $subject->id;
        $g->grade = $grade;
        $g->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Registrar Credited Subject Units');

        // add return value
        return redirect()->back()->with('success', 'Subject Credited to The student.');
    }

}
