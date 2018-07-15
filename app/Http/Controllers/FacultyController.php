<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Faculty;
use App\FacultyInfo;
use App\SubjectAssignment;
use App\Subject;
use App\Program;
use App\ProgramAssignment;
use App\SubjectStudent;
use App\ActiveSemester;
use App\AcademicYear;
use App\User;
use App\SubjectStudentMerge;
use App\YearLevel;
use App\Grade;
use App\GradeEncodeLog;


use App\Http\Controllers\GeneralController;

class FacultyController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:faculty');
    }


    // method use to view dashboard of faculty
    public function dashboard()
    {
    	return view('faculty.dashboard');
    }


    // method use to view profile of the faculty
    public function profile()
    {
    	return view('faculty.profile');
    }


    // method use to view form update of profile
    public function updateProfile()
    {
    	return view('faculty.profile-update');
    }


    // method use to update profile of faculty
    public function postUpdateProfile(Request $request)
    {
    	// validate request form data
    	$request->validate([
			'firstname' => 'required',
            'lastname' => 'required',
            'id_number' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'address' => 'required',
            'nationality' => 'required'
    	]);

    	// assign form data in variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];
        $dob = $request['date_of_birth'];
        $pob = $request['place_of_birth'];
        $address = $request['address'];
        $nationality = $request['nationality'];

    	// check


    	// save
        $faculty = Faculty::findorfail(Auth::guard('faculty')->user()->id);
        $faculty->firstname = $firstname;
        $faculty->lastname = $lastname;
        $faculty->id_number = $id;
        $faculty->mobile_number = $mobile;
        $faculty->save();

        $info = FacultyInfo::findorfail($faculty->id);
        $info->date_of_birth = date('Y-d-m', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->address = $address;
        $info->nationality = $nationality;
        $info->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 2, 'Update Facutly Profile');

        // return message
        return redirect()->route('faculty.profile')->with('success', 'Profile Updated!');

    }


    // method use to view password change 
    public function changePassword()
    {
    	return view('faculty.change-password');
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
        if(password_verify($old, Auth::guard('faculty')->user()->password)) {
            // change the password
            $faculty = Faculty::findorfail(Auth::guard('faculty')->user()->id);
            $faculty->password = bcrypt($new);
            $faculty->save();

            // activity log
            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 2, 'Faculty Change Password');

            return redirect()->route('faculty.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('faculty.password.change')->with('error', 'Old Password Invalid!');
    }


    // method use to view subject assignments
    public function viewSubjectAssignments()
    {
        // find active subject assignemnts of the faculty
        $subject_assignment = SubjectAssignment::where('faculty_id', Auth::guard('faculty')->user()->id)
                                    ->where('active', 1)
                                    ->first();

        $subjects = null;

        if(count($subject_assignment) > 0) {
            $subject_ids = unserialize($subject_assignment->subject_ids);

            foreach($subject_ids as $s) {
                $subjects = Subject::find($s);
            }
        }

        return view('faculty.subjects-assigned', ['subjects' => $subjects]);

    }


    // method use to view students enrolled in subject
    public function viewSubjectStudents($id = null)
    {
        $subject = Subject::find($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // check if the assigned subject belongs to the faculty
        $assigned_subject_ids = SubjectAssignment::where('faculty_id', Auth::user()->id)
                                ->where('academic_year_id', $ay->id)
                                ->where('semester_id', $sem->id)
                                ->where('active', 1)
                                ->first();


        if(count($assigned_subject_ids) < 1) {
            return redirect()->route('faculty.dashboard')->with('error', 'Invalid Modification Detected!');
        }


        // get group numbers
        $group_numbers = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->distinct('group_number')
                            ->get(['group_number']);




        return view('faculty.subject-students-groups', ['subject' => $subject, 'sem' => $sem, 'ay' => $ay, 'gn' => $group_numbers]);
    }



    // method use to view students in a subject 
    public function viewSubjectStudentsEnrolled($id = null, $gid = null)
    {
        $subject = Subject::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();


        $grade_log = GradeEncodeLog::where('faculty_id', Auth::guard('faculty')->user()->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->first();


        // find subject students
        $subject_students = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->where('group_number', $gid)
                            ->get(['student_id']);

        if(count($subject_students) < 1) {
            return abort(404);
        }

        $students = User::find($subject_students);
        $sorted = $students->sortBy('lastname');
        $sorted->values()->all();

        return view('faculty.subject-students', ['subject' => $subject, 'students' => $sorted, 'sem' => $sem, 'ay' => $ay, 'gid' => $gid, 'grade_log' => $grade_log]);

    }


    // method use to encode grade
    public function encodeSubjectStudentsGrade($id = null, $gid = null)
    {
        $subject = Subject::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // find subject students
        $subject_students = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->where('group_number', $gid)
                            ->get(['student_id']);

        if(count($subject_students) < 1) {
            return abort(404);
        }

        $students = User::find($subject_students);
        $sorted = $students->sortBy('lastname');
        $sorted->values()->all();

        return view('faculty.subject-students-encode-grades', ['subject' => $subject, 'students' => $sorted, 'sem' => $sem, 'ay' => $ay, 'gid' => $gid]);
    }


    // method use to save grades
    public function postEncodeSubjectStudentsGrade(Request $request)
    {
        $subject_id = $request['subject_id'];
        $gid = $request['group_number'];

        $subject = Subject::findorfail($subject_id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();


        $faculty = Faculty::find(Auth::guard('faculty')->user()->id);

        // get all grade inputs
        // find all students enrolled in subjects
        $student_ids = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->where('group_number', $gid)
                            ->get(['student_id']);

        $students = User::find($student_ids);

        // find student number and save the grade
        foreach($students as $s) {
            $term = 1;
            $remark = 'Failed';
            foreach($request[$s->student_number] as $g) {
                if($g > 75) {
                    $remark = 'Passed';
                }

                $grade = new Grade();
                $grade->student_id = $s->id;
                $grade->faculty_id = $faculty->id;
                $grade->subject_id = $subject->id;
                $grade->year_level_id = $subject->year_level;
                $grade->academic_year_id = $ay->id;
                $grade->semester_id = $sem->id;
                $grade->term_id = $term;
                $grade->grade = $g;
                $grade->remarks = $remark;
                $grade->save();

                $term += 1;
            }
            
        }

        // add log to the grade encode log for faculty
        $grade_log = new GradeEncodeLog();
        $grade_log->faculty_id = $faculty->id;
        $grade_log->academic_year_id = $ay->id;
        $grade_log->semester_id = $sem->id;
        $grade_log->year_level_id = $subject->year_level;
        $grade_log->subject_id = $subject->id;
        $grade_log->save();

        // activity log
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 2, 'Faculty Encoded Grades in ' . $subject->code);

        // successfull addedto grades
        return redirect()->route('faculty.subject.students.enrolled', ['id' => $subject->id, 'gid' => $gid])->with('success', 'Grades Encoded!');

    }


    // method use to view grades of students per subject
    public function viewGradesStudentsSubject($id = null, $gid = null)
    {
        $subject = Subject::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // find subject students
        $subject_students = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->where('group_number', $gid)
                            ->get(['student_id']);


        $students = User::orderBy('lastname', 'asc')->find($subject_students);

        // get grades of each students fro prelim to final terms
        $grades = null;

        foreach($students as $std) {
            // find all grades per subject in current sem and academic year
            $grades[] = Grade::where('student_id', $std->id)
                        ->where('subject_id', $subject->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->get();
        }

        // return $grades;

        // return to view grades
        return view('faculty.subject-students-grades', ['subject' => $subject, 'students' => $students, 'ay' => $ay, 'sem' => $sem, 'grades' => $grades, 'gid' => $gid]);
    }


    // method use to update grades of student in a subject
    public function updateSubjectStudentGrades($id = null, $gid = null, $sid = null)
    {
        $subject = Subject::findorfail($id);
        $student = User::findorfail($sid);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        // get the grade of teh student in a subject
        $grades = Grade::where('student_id', $student->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('subject_id', $subject->id)
                    ->get();


        return view('faculty.subject-student-grade-update', [ 
            'subject' => $subject,
            'student' => $student,
            'ay' => $ay,
            'sem' => $sem,
            'grades' => $grades,
            'gid' => $gid
        ]);

    }

    // method use to save update in grades
    public function postUpdateSubjectStuedentGrades(Request $request)
    {
        $request->validate([
            'prelim' => 'required|numeric',
            'midterm' => 'required|numeric',
            'semi_final' => 'required|numeric',
            'final' => 'required|numeric'
        ]);

        $subject_id = $request['subject_id'];
        $student_id = $request['student_id'];
        $gid = $request['gid'];

        $prelim = $request['prelim'];
        $midterm = $request['midterm'];
        $semi_final = $request['semi_final'];
        $final = $request['final'];

        $subject = Subject::find($subject_id);
        $student = User::find($student_id);

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
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 2, 'Faculty Updated Grade');

        // return to grades
        return redirect()->route('faculty.view.grades.students.subject', ['id' => $subject->id, 'gid' => $gid])->with('success', 'Grade Updated!');

    }


    // method use to view program assignemnt to the faculty
    public function viewProgramAssignments()
    {
        // find active program assignemnts of the faculty
        $program_assignment = ProgramAssignment::where('faculty_id', Auth::guard('faculty')->user()->id)
                                    ->where('active', 1)
                                    ->first();
        $programs = null;

        if(count($program_assignment) > 0) {
            $program_ids = unserialize($program_assignment->program_ids);

            foreach($program_ids as $s) {
                $programs = Program::find($s);
            }
        }

        return view('faculty.program-assigned', ['programs' => $programs]);

    }

}
