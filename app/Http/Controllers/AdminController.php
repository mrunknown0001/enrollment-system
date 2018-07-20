<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Admin;
use App\Cashier;
use App\ActivityLog;
use App\Registrar;
use App\Program;
use App\Course;
use App\Subject;
use App\User;
use App\Faculty;
use App\Payment;
use App\YearLevel;
use App\ActiveProgram;
use App\ActiveCourse;
use App\PricePerUnit;
use App\AcademicYear;
use App\ActiveSemester;
use App\MiscFee;
use App\Assessment;
use App\SubjectAssignment;
use App\ProgramAssignment;
use App\EnrollmentSetting;
use App\StudentPerSubject;
use App\SubjectStudent;
use App\Grade;
use App\Remark;
use App\Room;
use App\Schedule;

use App\Http\Controllers\GeneralController;

class AdminController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    // method use to view admin dashboard
    public function dashboard()
    {

    	// load all need in admin dashboard
        $students = User::get(['id']);
        $faculties = Faculty::get(['id']);
        $cashiers = Cashier::get(['id']);
        $registrars = Registrar::get(['id']);
        $subjects = Subject::get(['id']);

        $programs = Program::where('active', 1)->get();
        $courses = Course::where('active', 1)->get();
        $yl = YearLevel::where('active', 1)->first();

        $es = EnrollmentSetting::find(1);

        // get total payment of the current enrollment
        $payments = Payment::where('status', 1)->get();
        $total_payment = null;

        foreach($payments as $p) {
            $total_payment += $p->amount;
        }


    	return view('admin.dashboard', ['students' => $students, 'faculties' => $faculties, 'cashiers' => $cashiers, 'registrars' => $registrars, 'subjects' => $subjects, 'programs' => $programs, 'courses' => $courses, 'yl' => $yl, 'payment' => $total_payment, 'es' => $es]);
    }


    // method use to view profile of the admin
    public function profile()
    {
        return view('admin.profile');
    }


    // method use to view update profile
    public function profielUpdate()
    {
        return view('admin.profile-update');
    }


    // method use to update profile of admin
    public function postProfileUpdate(Request $request)
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

        // update 
        $admin = Admin::findorfail(Auth::guard('admin')->user()->id);
        $admin->firstname = $firstname;
        $admin->lastname = $lastname;
        $admin->id_number = $id;
        $admin->mobile_number = $mobile;
        $admin->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Update Admin Profile');


        return redirect()->route('admin.profile');
    }


    // method use to view change password form
    public function changePassword()
    {
        return view('admin.change-password');
    }


    // method use to change password
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
        if(password_verify($old, Auth::guard('admin')->user()->password)) {
            // change the password
            $admin = Admin::findorfail(Auth::guard('admin')->user()->id);
            $admin->password = bcrypt($new);
            $admin->save();

            // activity log
            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Change Password');

            return redirect()->route('admin.change.password')->with('success', 'Password Changed!');
        }

        return redirect()->route('admin.change.password')->with('error', 'Old Password Invalid!');
    }


    // method use to show activity logs
    public function activityLog()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('admin.activity-log', ['logs' => $logs]);
    }


    // method use to view cashiers
    public function viewCashiers()
    {
        // get all cashiers
        $cashiers = Cashier::orderBy('lastname', 'asc')
                        ->paginate(15);

        return view('admin.cashiers', ['cashiers' => $cashiers]);
    }


    // method use to reset cashier password to default
    public function postResetCashierPassword(Request $request)
    {
        $id = $request['id'];

        $cashier = Cashier::findorfail($id);
        $cashier->password = bcrypt('cashier');
        $cashier->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Reset Cashier Password: ' . $cashier->firstname . ' ' . $cashier->lastname);

        return redirect()->route('admin.view.cashiers')->with('success', 'Reset to default password. Success!');

    }


    // method use to view add cashier form
    public function addCashier()
    {
        return view('admin.add-cashier');
    }


    // method use to add cashier
    public function postAddCashier(Request $request)
    {

        // validate form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'id_number' => 'required|unique:cashiers',
            'mobile_number' => 'required|unique:cashiers'
        ]);


        // assign form data to variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $username = $request['username'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];


        // check


        // save cashier
        $cashier = new Cashier();
        $cashier->username = $username;
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->id_number = $id;
        $cashier->mobile_number = $mobile;
        $cashier->password = bcrypt('cashier');
        $cashier->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Cashier Account');

        // return data with message
        return redirect()->route('admin.view.cashiers')->with('success', 'Cashier Added!');

    }


    // method use to view registrars
    public function viewRegistrars()
    {
        $registrars = Registrar::orderBy('lastname', 'asc')
                            ->paginate(15);

        return view('admin.registrars', ['registrars' => $registrars]);
    }


    // method use to reset registrar password to default
    public function postResetRegistrarPassword(Request $request)
    {
        $id = $request['id'];

        $registrar = Registrar::findorfail($id);
        $registrar->password = bcrypt('registrar');
        $registrar->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Reset Registrar Password: ' . $registrar->firstname . ' ' . $registrar->lastname);

        return redirect()->route('admin.view.registrars')->with('success', 'Reset to default password. Success!');

    }


    // method use to view add form of registrar
    public function addRegistrar()
    {
        return view('admin.add-registrar');
    }


    // method use to save new registrar
    public function postAddRegistrar(Request $request)
    {

        // validate form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'id_number' => 'required|unique:cashiers',
            'mobile_number' => 'required|unique:cashiers'
        ]);


        // assign form data to variables
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $username = $request['username'];
        $id = $request['id_number'];
        $mobile = $request['mobile_number'];


        // check


        // save cashier
        $cashier = new Registrar();
        $cashier->username = $username;
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->id_number = $id;
        $cashier->mobile_number = $mobile;
        $cashier->password = bcrypt('registrar');
        $cashier->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Registrar Account');

        // return data with message
        return redirect()->route('admin.view.registrars')->with('Registrar Added!');

    }


    // method use to view all faculties
    public function viewFaculties()
    {
        $faculties = Faculty::orderBy('lastname', 'asc')
                            ->paginate(10);


        return view('admin.faculties', ['faculties' => $faculties]);
    }


    // method use to view faculty details
    public function viewFacultyDetails($id = null)
    {
        $faculty = Faculty::findorfail($id);

        // get assginec subjects and/or programs assigned
        $programs_assigned = ProgramAssignment::where('faculty_id', $faculty->id)->where('active', 1)->first();
        $subjects_assigned = SubjectAssignment::where('faculty_id', $faculty->id)->where('active', 1)->first();

        $programs = null;
        $subjects = null;

        if(count($programs_assigned) > 0) {
            foreach(unserialize($programs_assigned->program_ids) as $p) {
                $programs = Program::find($p);
            }
        }

        if(count($subjects_assigned) > 0) {
            foreach(unserialize($subjects_assigned->subject_ids) as $s) {
                $subjects = Subject::find($s);
            }
        }

        return view('admin.faculty-details', ['faculty' => $faculty, 'programs' => $programs, 'subjects' => $subjects]);
    }


    // method use to add load to faculty
    public function addLoadFaculty($id = null)
    {
        $faculty = Faculty::findorfail($id);

        
         return view('admin.add-faculty-load', ['faculty' => $faculty]); 
        
    }


    // method use to add subject load to faculty
    public function addSubjectLoadFaculty($id = null)
    {
        $faculty = Faculty::findorfail($id);

        $subjects = Subject::where('active', 1)->get();

        if(count($subjects) < 1) {
            return redirect()->back()->with('error', 'No Active Subject!');
        }

        return view('admin.assign-subjects', ['faculty' => $faculty, 'subjects' => $subjects]);
    }


    // method use to save subject load 
    public function postAddSubjectLoadFaculty(Request $request)
    {
        $request->validate(['subjects' => 'required']);

        $subject_ids[] = $request['subjects']; // save in subject ids in serialized format
        $faculty_id = $request['faculty_id'];


        $faculty = Faculty::findorfail($faculty_id);

        // get active semester
        $sem = ActiveSemester::where('active', 1)->first();

        // get active academic year
        $ay = AcademicYear::where('active', 1)->first();

        // check if there is active sem and ay
        if(count($sem) < 1 || count($ay) < 1) {
            return redirect()->back()->with('error', 'No Active Semester or Academic Year!');
        }

        $sa = new SubjectAssignment();
        $sa->faculty_id = $faculty->id;
        $sa->academic_year_id  = $ay->id;
        $sa->semester_id = $sem->id;
        $sa->subject_ids = serialize($subject_ids);
        $sa->save();

        // add activitly log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Assign Subject to ' . ucwords($faculty->firstname . ' ' . $faculty->lastname));

        // return to faculty lists
        return redirect()->route('admin.view.faculties')->with('success', 'Subject Load Assigned to ' . ucwords($faculty->firstname . ' ' . $faculty->lastname));

    }


    // method use to add program load
    public function addProgramLoadFaculty($id = null)
    {
        $faculty = Faculty::findorfail($id);

        $programs = Program::where('active', 1)->get();

        if(count($programs) < 1) {
            return redirect()->back()->with('error', 'No Active Program!');
        }

        return view('admin.assign-program', ['faculty' => $faculty, 'programs' => $programs]);
    }


    // method use to save program load to faculty
    public function postAddProgramLoadFaculty(Request $request)
    {
        $request->validate(['programs' => 'required']);

        $program_ids[] = $request['programs'];
        $faculty_id = $request['faculty_id'];

        $faculty = Faculty::findorfail($faculty_id);

        // get active semester
        $sem = ActiveSemester::where('active', 1)->first();

        // get active academic year
        $ay = AcademicYear::where('active', 1)->first();

        // check if there is active sem and ay
        if(count($sem) < 1 || count($ay) < 1) {
            return redirect()->back()->with('error', 'No Active Semester or Academic Year!');
        }


        $pa = new ProgramAssignment();
        $pa->faculty_id = $faculty->id;
        $pa->academic_year_id = $ay->id;
        $pa->semester_id = $sem->id;
        $pa->program_ids = serialize($program_ids);
        $pa->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Assigned Program to ' . ucwords($faculty->firstname . ' ' . $faculty->lastname));

        // return to faculty lists
        return redirect()->route('admin.view.faculties')->with('success', 'Program Load Assigned to ' . ucwords($faculty->firstname . ' ' . $faculty->lastname));


    }


    // method use to view update in faculty load
    public function updateFacultyLoad($id = null)
    {
        $faculty = Faculty::findorfail($id);

        // get subject / program assignment
        $programs_assigned = ProgramAssignment::where('faculty_id', $faculty->id)->where('active', 1)->first();
        $subjects_assigned = SubjectAssignment::where('faculty_id', $faculty->id)->where('active', 1)->first();

        return view('admin.update-faculty-load', ['faculty' => $faculty, 'programs_assigned' => $programs_assigned, 'subjects_assigned' => $subjects_assigned]);

    }


    // method use to update faculty load subject
    public function updateFacultyLoadSubjects($id = null)
    {
        $faculty = Faculty::findorfail($id);

        $subjects = Subject::where('active', 1)->get();

        if(count($subjects) < 1) {
            return redirect()->back()->with('error', 'No Active Subject!');
        }

        $subjects_assignment = SubjectAssignment::where('faculty_id', $faculty->id)
                                                ->where('active', 1)
                                                ->first();

        if(count($subjects_assignment) < 1) {
            return redirect()->back()->with('error', 'No Assigned Subject!');
        }

        return view('admin.update-assign-subjects', ['faculty' => $faculty, 'subjects' => $subjects, 'sa' => $subjects_assignment]);
    }


    public function postUpdateFacultyLoadSubjects(Request $request)
    {
        $request->validate([
            'subjects' => 'required'
        ]);

        $faculty_id = $request['faculty_id'];
        $sa_id = $request['subjects_assigned_id'];
        $subject_ids[] = $request['subjects'];

        $faculty = Faculty::findorfail($faculty_id);
        $sa = SubjectAssignment::findorfail($sa_id);

        // additional check if the sa belongs to the faculty
        if($faculty->id != $sa->faculty_id) {
            return redirect()->back()->with('error', 'Tampering Occured! Please Go to dashboard');
        }

        $sa->subject_ids = serialize($subject_ids);
        $sa->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Update Assigned Subjects to ' . ucwords($faculty->firstname . ' ' . $faculty->lastname));

        return redirect()->route('admin.view.faculties')->with('success', 'Assigned Subjects Updated!');
    }

    // method use to update program assignement
    public function updateFacultyLoadPrograms($id = null)
    {
        $faculty = Faculty::findorfail($id);

        $programs = Program::where('active', 1)->get();

        if(count($programs) < 1) {
            return redirect()->back()->with('error', 'No Active Program!');
        }

        $pa = ProgramAssignment::where('faculty_id', $faculty->id)
                                ->where('active', 1)
                                ->first();

        return view('admin.update-assign-program', ['faculty' => $faculty, 'programs' => $programs, 'pa' => $pa]);
    }


    // method use to save update on program assignent
    public function postUpdateFacultyLoadPrograms(Request $request)
    {
        $request->validate(['programs' => 'required']);

        $program_ids[] = $request['programs'];
        $faculty_id = $request['faculty_id'];
        $pa_id = $request['program_assignment_id'];

        $faculty = Faculty::findorfail($faculty_id);

        $pa = ProgramAssignment::findorfail($pa_id);

        // additional check if the sa belongs to the faculty
        if($faculty->id != $pa->faculty_id) {
            return redirect()->back()->with('error', 'Tampering Occured! Please Go to dashboard');
        }

        $pa->program_ids = serialize($program_ids);
        $pa->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Update Assigned Programs to ' . ucwords($faculty->firstname . ' ' . $faculty->lastname));

        return redirect()->route('admin.view.faculties')->with('success', 'Assigned Programs Updated!');

    }



    // method use to view programs available 
    public function viewPrograms()
    {
        // get all programs offered
        $programs = Program::orderBy('title', 'asc')
                        ->paginate(5);

        return view('admin.programs', ['programs' => $programs]);
    }


    // method use to view add program form
    public function addProgram()
    {
        return view('admin.add-program');
    }


    // method use to add program
    public function postAddProgram(Request $request)
    {
        // validate request form data
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:programs',
            'tuition_fee' => 'required'
        ]);


        // assing validated data to variables
        $title = $request['title'];
        $code = $request['code'];
        $desc = $request['description'];
        $fee = $request['tuition_fee'];

        // other checking


        // save new program
        $program = new Program();
        $program->title = $title;
        $program->code = $code;
        $program->description = $desc;
        $program->tuition_fee = $fee;
        $program->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Program');


        // return with success message
        return redirect()->route('admin.view.programs')->with('success', 'Program Added!');
    }


    // method use to show update form for program
    public function updateProgram($id = null)
    {
        $program = Program::findorfail($id);

        return view('admin.update-program', ['program' => $program]);
    }


    // method use to save update in program
    public function postUpdateProgram(Request $request)
    {
        // validate form date
        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'tuition_fee' => 'required'
        ]);

        // assign form date to variable
        $id = $request['id'];
        $title = $request['title'];
        $code = $request['code'];
        $desc = $request['description'];
        $fee = $request['tuition_fee'];

        $program = Program::findorfail($id);

        // check title, code existence
        if($program->title != $title) {
            // find if there is existed
            if(Program::where('title', $title)->exists()) {
                return redirect()->route('admin.update.program', ['id' => $program->id])->with('error', 'Title already exist!');
            }
        }

        if($program->code != $code) {
            // find if there is existed
            if(Program::where('code', $code)->exists()) {
                return redirect()->route('admin.update.program', ['id' => $program->id])->with('error', 'Code already exist!');
            }
        }

        // save changes
        $program->title = $title;
        $program->code = $code;
        $program->description = $desc;
        $program->tuition_fee = $fee;
        $program->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Program');

        // return with message
        return redirect()->route('admin.view.programs')->with('success', 'Program Updated!');

    }


    // method use to view courses
    public function viewCourses()
    {
        // load all course
        $courses = Course::orderBy('title', 'asc')
                        ->paginate(15);

        return view('admin.courses', ['courses' => $courses]);
    }


    // method use to add course
    public function addCourse()
    {
        return view('admin.add-course');
    }


    // method use to save add course
    public function postAddCourse(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required|unique:courses',
            'code' => 'required|unique:courses'
        ]);

        // assign to variables
        $title = $request['title'];
        $code = $request['code'];
        $desc = $request['description'];

        // save
        $course = new Course();
        $course->title = $title;
        $course->code = $code;
        $course->description = $desc;
        $course->save();

        // add log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Course');

        // return message
        return redirect()->route('admin.courses')->with('success', 'Course Added!');
    }

    // method use to show course update form
    public function updateCourse($id = null)
    {
        $course = Course::findorfail($id);

        return view('admin.update-course', ['course' => $course]);
    }


    // method use to save update on course
    public function postUpdateCourse(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required',
            'code' => 'required'
        ]);

        // assign to variables
        $id = $request['id'];
        $title = $request['title'];
        $code = $request['code'];
        $desc = $request['description'];

        $course = Course::findorfail($id);

        // check title and code
        if($course->title != $title) {
            if(Course::where('title', $title)->exists()) {
                return redirect()->route('admin.update.course', ['id' => $course->id])->with('error', 'Title Already Exist!');
            }
        }

        if($course->code != $code) {
            if(Course::where('code', $code)->exists()) {
                return redirect()->route('admin.update.course', ['id' => $course->id])->with('error', 'Code Already Exist!');
            }
        }


        // update
        $course->title = $title;
        $course->code = $code;
        $course->description = $desc;
        $course->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Course');

        // return message
        return redirect()->route('admin.courses')->with('success', 'Course Updated!');

    }


    // method use to view all subjects
    public function viewSubjects()
    {
        $subjects = Subject::orderBy('active', 'desc')
                        ->orderBy('code', 'asc')
                        ->paginate(15);

        return view('admin.subjects', ['subjects' => $subjects]);
    }


    // method use to view active subjects only
    public function viewActiveSubjects()
    {
        $subjects = Subject::where('active', 1)
                        ->orderBy('code', 'asc')
                        ->paginate(15);

        return view('admin.subjects-active', ['subjects' => $subjects]);
    }

    // method use to view students enrolled in subject
    public function viewEnrolledStudentsSubject($id = null)
    {
        $subject = Subject::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        if(count($ay) < 1) {
            return redirect()->back()->with('error', 'No Active Academic Year!');
        }

         if(count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Semester!');
        }

        // check if subject is inactive
        if($subject->active != 1) {
            return redirect()->back()->with('error', 'Subject Inactive!');
        }

        // get all students enrolled
        $enrolled = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->get();
        // check if there is no enrolled students
        if(count($enrolled) < 1) {
            return redirect()->back()->with('error', 'No Enrolled Students on ' . $subject->code);
        }

        // get distinct group_number in $enrolled colection
        $group_numbers = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->distinct('group_number')
                            ->get(['group_number']);

        $enrolled_id = [];

        foreach($enrolled as $e) {
            $enrolled_id[] = $e->student_id;
        }

        // get all students
        $students = [];

        $students = User::find($enrolled_id);

        $students_sorted = $students->sortBy('lastname');
        $students_sorted->values()->all();

        return view('admin.students-enrolled', ['students' => $students_sorted, 'subject' => $subject, 'gn' => $group_numbers, 'enrolled' => $enrolled]);
    }


    // route to manage groups in subject students
    public function manageSubjectStudentsGroup($id = null)
    {
        $subject = Subject::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();


        // get all students enrolled
        $enrolled = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->get();

        // get distinct group_number in $enrolled colection
        $group_numbers = SubjectStudent::where('academic_year_id', $ay->id)
                            ->where('semester', $sem->id)
                            ->where('subject_id', $subject->id)
                            ->distinct('group_number')
                            ->get(['group_number']);

        $gn_count = count($group_numbers);

        $students_group1 = [];        
        $students_group2 = [];
        $students_group3 = [];

        // get number of students in each group
        for($i = 1; $i <= $gn_count; $i++) {
            if($i == 1) {
               $students_group1[] = SubjectStudent::where('academic_year_id', $ay->id)
                                    ->where('semester', $sem->id)
                                    ->where('subject_id', $subject->id)
                                    ->where('group_number', $i)
                                    ->get();
            }

            if($i == 2) {
               $students_group2[] = SubjectStudent::where('academic_year_id', $ay->id)
                                    ->where('semester', $sem->id)
                                    ->where('subject_id', $subject->id)
                                    ->where('group_number', $i)
                                    ->get();
            }

            if($i == 3) {
               $students_group3[] = SubjectStudent::where('academic_year_id', $ay->id)
                                    ->where('semester', $sem->id)
                                    ->where('subject_id', $subject->id)
                                    ->where('group_number', $i)
                                    ->get();
            }
        }


        // return subject and group numbers
        return view('admin.subject-group-manager', ['subject' => $subject, 'gn' => $group_numbers, 'students_group1' => $students_group1, 'students_group2' => $students_group2, 'students_group3' => $students_group3 ]);

    }


    // method use to save merge students group
    public function postManageSubjectStudentsGroup(Request $request)
    {
        $group[] = $request['group'];
        $subject_id = $request['subject_id'];

        $subject = Subject::findorfail($subject_id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $first_group = $group[0][0];

        $students_enrolled = [];


        $students_enrolled[] = SubjectStudent::where('academic_year_id', $ay->id)
                                ->where('semester', $sem->id)
                                ->where('subject_id', $subject->id)
                                ->whereIn('group_number', $group[0])
                                ->update([
                                    'group_number' => $first_group
                                ]);

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Merged Subject Students');


        return redirect()->route('admin.view.enrolled.students.subject', ['id' => $subject->id])->with('success', 'Group Merged!');

    }

    // method use  to view add subject form
    public function addSubject()
    {
        $yl = YearLevel::get(['id', 'name']);
        $subjects = Subject::orderBy('code')->get(['id', 'code']);

        return view('admin.add-subject', ['yl' => $yl, 'subjects' => $subjects]);
    }


    // method use to save added subject
    public function postAddsubject(Request $request)
    {
        // validate request data
        $request->validate([
            'code' => 'required|unique:subjects',
            'units' => 'required',
            'hours' => 'required',
            'year_level' => 'required'
        ]);

        // assing to variables
        $code = $request['code'];
        $desc = $request['description'];
        $units = $request['units'];
        $hours = $request['hours'];
        $yl = $request['id'];
        $prereq = $request['prerequisite'];

        // save
        $subject = new Subject();
        $subject->code = $code;
        $subject->description = $desc;
        $subject->units = $units;
        $subject->hours = $hours;
        $subject->year_level = $yl;
        $subject->prerequisites = $prereq;
        $subject->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Subject');

        // return with message
        return redirect()->route('admin.subjects')->with('success', 'Successfully Added Subject!');
    }


    // method use to show update form of subjects
    public function updateSubject($id = null)
    {
        $subject = Subject::findorfail($id);
        $yl = YearLevel::get(['id', 'name']);
        $subjects = Subject::orderBy('code')->get(['id', 'code']);

        return view('admin.update-subject', ['subject' => $subject, 'yl' => $yl, 'subjects' => $subjects]);
    }


    // method use to save update in subject
    public function postUpdatesubject(Request $request)
    {
        // validate request data
        $request->validate([
            'code' => 'required',
            'units' => 'required',
            'hours' => 'required',
            'year_level' => 'required'
        ]);

        // assing to variables
        $id = $request['id'];
        $code = $request['code'];
        $desc = $request['description'];
        $units = $request['units'];
        $hours = $request['hours'];
        $yl = $request['year_level'];
        $prereq = $request['prerequisite'];

        $subject = Subject::findorfail($id);

        // check  code manual

        if($subject->code != $code) {
            if(Subject::where('code', $code)->exists()) {
                return redirect()->route('admin.update.subject', ['id' => $subject->id])->with('error', 'Code Already Exist!');
            }
        }


        // save
        $subject->code = $code;
        $subject->description = $desc;
        $subject->units = $units;
        $subject->hours = $hours;
        $subject->year_level = $yl;
        $subject->prerequisites = $prereq;
        $subject->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Subject');

        // return with message
        return redirect()->route('admin.subjects')->with('success', 'Subject Update Success!');

    }


    // method use to select subject
    public function selectSubjects()
    {
        $subjects = Subject::all(['id', 'code', 'description', 'year_level', 'active']);

        return view('admin.select-subjects', ['subjects' => $subjects]);
    }


    // method use to save selected subjects
    public function postSelectSubjects(Request $request)
    {
        $subject_ids[] = $request['subjects'];

        foreach($subject_ids as $id) {
            $subjects = Subject::find($id);
        }

        foreach($subjects as $sub) {
            $sub->active = 1;
            $sub->save();
        }

        // activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Selected Subjects');

        return redirect()->route('admin.subjects')->with('success', 'Subject Selected!');
    }


    // method use to show update price form
    public function pricePerUnitUpdate()
    {
        $price = PricePerUnit::find(1);

        return view('admin.update-price-per-unit', ['price' => $price]);
    }


    // method use to save update on price per unit
    public function postPricePerUnitUpdate(Request $request)
    {
        // validate
        $request->validate([
            'price' => 'required|numeric'
        ]);

        // assign to variable
        $price = $request['price'];

        // save
        $up  = PricePerUnit::find(1);
        $up->price = $price;
        $up->save();
    
        // add activity log here
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Updated Price Per Unit');

        // return with message success 
        return redirect()->route('admin.rate.fee.settings')->with('success', 'Price Per Unit Updated!');
    
    }


    // method use to view all students
    public function viewStudents()
    {
        // get all active and enrolled students
        $students = User::orderBy('lastname', 'asc')
                        ->paginate(10);

        $max = StudentPerSubject::find(1);

        return view('admin.students', ['students' => $students, 'max' => $max]);
    }


    // method use to view student grades
    public function viewStudentGrades($id = null)
    {
        $student = User::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $course = Course::find($student->info->course_id);

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

        return view('admin.student-view-grades', [
            'student' => $student,
            'grades' => $grades,
            'subjects' => $subjects,
            'course' => $course,
            'ay' => $ay,
            'sem' => $sem
        ]);

    }


    // method use to view student remarks
    public function viewStudentRemarks($id = null)
    {
        $student = User::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $program = Program::find($student->info->program_id);

        // get the remarks
        $remarks = Remark::where('academic_year_id', $ay->id)
                        ->where('student_id', $student->id)
                        ->where('semester_id', $sem->id)
                        ->where('program_id', $program->id)
                        ->first();

        return view('admin.student-view-remarks', ['student' => $student, 'ay' => $ay, 'sem' => $sem, 'program' => $program, 'remarks' => $remarks]);
    }


    // method use to set max student per subject class
    public function setMaxStudentNumber()
    {
        return view('admin.set-max-student-number');
    }

    // method use to save set max number of student per subject class
    public function postSetMaxStudentNumber(Request $request)
    {
        $request->validate([
            'limit' =>  'required|numeric'
        ]);

        $limit = $request['limit'];

        $max = StudentPerSubject::find(1);
        $max->limit = $limit;
        $max->save();

        // add activity log here
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Updated max number of student per subjects');

        $students = User::orderBy('lastname', 'asc')
                        ->paginate(10);

        return redirect()->route('admin.students')->with('success', 'Updated Max Number of Student Per Subject Class to ' . $limit);




    }


    // method use to search students
    public function searchStudent(Request $request)
    {
        $keyword = $request['keyword'];

        $students = GeneralController::students_search($keyword);

        return view('admin.students-search-result', ['students' => $students, 'keyword' => $keyword]);
    }


    // method use toview year levels
    public function viewYearLevels()
    {
        $yl = YearLevel::get();

        return view('admin.year-levels', ['yl' => $yl]);
    }


    // method use to view add year level form
    public function addYearLevel()
    {
        return view('admin.add-year-level');
    }


    // method use to save new year level 
    public function postAddYearLevel(Request $request)
    {
        // validate form data
        $request->validate([
            'name' => 'required'
        ]);


        // assign form data to variable
        $name = $request['name'];
        $desc = $request['description'];


        // save
        $yl = new YearLevel();
        $yl->name = $name;
        $yl->description = $desc;
        $yl->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Year Level');

        // return with message
        return redirect()->route('admin.view.year.level')->with('success', 'Added Year Level');

    }


    // method use to view update form year level
    public function updateYearLevel($id = null)
    {
        $yl = YearLevel::findorfail($id);

        return view('admin.update-year-level', ['yl' => $yl]);
    }


    // method use to save update on year level
    public function postUpdateYearLevel(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required'
        ]);

        // assgin to variables
        $id = $request['id'];
        $name = $request['name'];
        $desc = $request['description'];

        $yl = YearLevel::findorfail($id);

        // save update
        $yl->name = $name;
        $yl->description = $desc;
        $yl->save();

        // add actviity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Update Year Level');

        // return with message
        return redirect()->route('admin.view.year.level')->with('success', 'Year Level Updated!');
    }


    // method use to view academic yea 
    public function viewAcademicYear()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = ActiveSemester::where('active', 1)->first();

        $ays = AcademicYear::where('active', 0)
                        ->orderBy('id', 'desc')
                        ->paginate(5);

        return view('admin.academic-year', ['ay' => $ay, 'sem' => $sem, 'ays' => $ays]);
    }


    // method use to view add academic year form
    public function addAcademicYear()
    {
        return view('admin.add-academic-year');
    }


    // method use tosave academic year
    public function postAddAcademicYear(Request $request)
    {
        // validate
        $request->validate([
            'from' => 'required',
            'to' => 'required'
        ]);

        // save to variable
        $from = $request['from'];
        $to = $request['to'];

        // check
        $check_ay = AcademicYear::where('from', $from)->first();

        if(count($check_ay) > 0) {
            return redirect()->route('admin.academic.year')->with('error', 'Academic Year Exist!');
        }

        // save
        $ay = new AcademicYear();
        $ay->from = $from;
        $ay->to = $to;
        $ay->save();

        // activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Add Academic Year');

        // return to home\
        return redirect()->route('admin.academic.year')->with('success', 'Successfully Added School Year');

    }


    // method use to close academic year
    public function postCloseAcademicYear(Request $request)
    {
        $password = $request['password'];

        // password verify
        if(password_verify($password, Auth::guard('admin')->user()->password)) {
            // ay and sem active to 0
            $ay = AcademicYear::where('active', 1)->first();
            $ay->active = 0;
            $ay->save();

            $sem = ActiveSemester::where('active', 1)->first();
            $sem->active = 0;
            $sem->save();

            //////////////////////////////////////
            // all operations will perform here //
            //////////////////////////////////////

            // add activity log
            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Close Academic Year: ' . $ay->from . '-' . $ay->to);

            return redirect()->route('admin.academic.year')->with('success', 'Academic Year Cloase!');
        }

        return redirect()->route('admin.academic.year')->with('error', 'Error Occured!');
    }


    // method use to set semester
    public function postSetSemester(Request $request)
    {
        $request->validate([
            'semester' => 'required'
        ]);

        $sem = $request['semester'];

        $semester = ActiveSemester::findorfail($sem);
        $semester->active = 1;
        $semester->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Set Semester');

        return redirect()->route('admin.academic.year')->with('success', 'Semester Set!');
    }


    // method to set next semester
    public function setSemester($id = null)
    {
        $active = ActiveSemester::where('active', 1)->first();
        $active->active = 0;
        $active->save();

        $semester = ActiveSemester::findorfail($id);
        $semester->active = 1;
        $semester->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Set Semester');

        return redirect()->route('admin.academic.year')->with('success', 'Semester Set!');
    }


    // method use to view rates and fees
    public function viewRateFeeSettings()
    {
        // get the current price per unit and the misc fee
        $unit_price = PricePerUnit::find(1);
        $misc = MiscFee::get();

        return view('admin.rates-fees', ['unit_price' => $unit_price, 'misc' => $misc]);
    }


    // method use to add form
    public function addMiscFee()
    {
        return view('admin.add-misc-fee');
    }


    // method to add misc fee
    public function postAddMiscFee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required'
        ]);

        $name = $request['name'];
        $amount = $request['amount'];
        $type = $request['type'];

        $misc = new MiscFee();
        $misc->name = $name;
        $misc->amount = $amount;
        $misc->type = $type;
        $misc->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Miscellaneous Fee');

        return redirect()->route('admin.rate.fee.settings')->with('success', 'Miscellaneous Fee Added');
    }


    // method use to update misc fee form
    public function updateMiscFee($id = null)
    {
        $misc = MiscFee::findorfail($id);

        return view('admin.update-misc-fee', ['misc' => $misc]);
    }


    // method use to save update
    public function postUpdateMiscFee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required'
        ]);

        $id = $request['id'];
        $name = $request['name'];
        $amount = $request['amount'];
        $type = $request['type'];

        $misc = MiscFee::findorfail($id);
        $misc->name = $name;
        $misc->amount = $amount;
        $misc->type = $type;
        $misc->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Miscellaneous Fee');

        return redirect()->route('admin.rate.fee.settings')->with('success', 'Miscellaneous Fee Updated');

    }


    // method to delete misc fee
    public function deleteMiscFee($id = null)
    {
        $misc = MiscFee::findorfail($id);
        $misc->delete();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Deleted Miscellaneous Fee');

        return redirect()->route('admin.rate.fee.settings')->with('success', 'Miscellaneous Fee Deleted'); 
    }


    // method use to view rooms
    public function viewRooms()
    {
        // get all rooms available
        $rooms = Room::get();

        return view('admin.rooms', ['rooms' => $rooms]);
    }


    // method use to add room
    public function addRoom()
    {
        return view('admin.add-room');
    }


    // method use to save added room
    public function postAddRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required'
        ]);

        $name = $request['room_name'];
        $number = $request['room_number'];

        // add room here
        $room = new Room();
        $room->name = $name;
        $room->room_number = $number;
        $room->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Add Room');

        // return to rooms
        return redirect()->route('admin.view.rooms')->with('success', 'New Room Added!');
    }


    // method use to update room
    public function updateRoom($id = null)
    {
        $room = Room::findorfail($id);

        return view('admin.update-room', ['room' => $room]);
    }


    // method use to save update in room
    public function postUpdateRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required'
        ]);

        $name = $request['room_name'];
        $number = $request['room_number'];
        $room_id = $request['room_id'];

        $room = Room::findorfail($room_id);
        $room->name = $name;
        $room->room_number = $number;
        $room->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Room');

        // return to rooms
        return redirect()->route('admin.view.rooms')->with('success', 'Room Updated!');
    }


    // method use to view schedules
    public function viewSchedules()
    {
        // get acdtive schedules
        $schedules = Schedule::where('active', 1)->get();
        $mon = Schedule::where('active', 1)->where('day', 1)->orderBy('time_start', 'asc')->get();
        $tue = Schedule::where('active', 1)->where('day', 2)->orderBy('time_start', 'asc')->get();
        $wed = Schedule::where('active', 1)->where('day', 3)->orderBy('time_start', 'asc')->get();
        $thu = Schedule::where('active', 1)->where('day', 4)->orderBy('time_start', 'asc')->get();
        $fri = Schedule::where('active', 1)->where('day', 5)->orderBy('time_start', 'asc')->get();
        $sat = Schedule::where('active', 1)->where('day', 6)->orderBy('time_start', 'asc')->get();
        $sun = Schedule::where('active', 1)->where('day', 7)->orderBy('time_start', 'asc')->get();

        return view('admin.schedules', ['schedules' => $schedules, 'monday' => $mon, 'tuesday' => $tue, 'wednesday' => $wed, 'thursday' => $thu, 'friday' => $fri, 'saturday' => $sat, 'sunday' => $sun]);
    }


    // method use to add schedule
    public function addSchedule()
    {
        // get rooms, subjects active
        $rooms = Room::get(['id', 'name']);
        $subjects = Subject::where('active', 1)
                ->orderBy('code', 'asc')
                ->get(['id', 'code']);

        return view('admin.add-schedule', ['rooms' => $rooms, 'subjects' => $subjects]);
    }


    // method use to save added schedule
    public function postAddSchedule(Request $request)
    {
        $request->validate([
            'room' => 'required',
            'subject' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $room_id = $request['room'];
        $subject_id = $request['subject'];
        $day = $request['day'];
        $st = $request['start_time'];
        $et = $request['end_time'];

        $subject = Subject::findorfail($subject_id);
        $room = Room::findorfail($room_id);

        if($st > $et) {
            return redirect()->back()->with('error', 'Invalid End Time. End Time must later than STart Time');
        }

        //////////////////////////////////////////////////////
        // check if there is dupplicate or confict schedule //
        //////////////////////////////////////////////////////
        // check for duplicate
        $schedule = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('subject_id', $subject->id)
                        ->where('day', $day)
                        ->where('time_start', $st)
                        ->where('time_end', $et)
                        ->first();
        if(count($schedule) > 0) {
            return redirect()->back()->with('error', 'Duplicate Schedule Found!');
        }

        $schedule = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->where('time_start', $st)
                        ->where('time_end', $et)
                        ->first();
        if(count($schedule) > 0) {
            return redirect()->back()->with('error', 'Time Slot Filled Up!');
        }

        // ckeck for start time conflict on the day
        $schedules = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->get();

        foreach($schedules as $sch) {
            if(($sch->time_end > $st && $sch->time_end < $et) || ($sch->time_start > $st && $sch->time_start < $et) || $sch->time_start == $st || $sch->time_end == $et) {
                return redirect()->back()->with('error', 'Time conflict on ' . GeneralController::get_day($sch->day) . ' ' . GeneralController::get_time($sch->time_start) . '-' . GeneralController::get_time($sch->time_end));
            }
        }


        // add new sched
        $sched = new Schedule();
        $sched->room_id = $room->id;
        $sched->subject_id = $subject->id;
        $sched->day = $day;
        $sched->time_start = $st;
        $sched->time_end = $et;
        $sched->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Schedule');

        // return to schedules
        return redirect()->back()->with('success', 'Schedule Added!');

    }


    // method use to view enrollment settings
    public function enrollment()
    {
        // get all courses and program
        $programs = Program::get(['id', 'title', 'active']);
        $courses = Course::get(['id', 'title', 'active']);

        $yl = YearLevel::get(['id', 'name', 'active']);

        // check if there is active academic year
        $ay = AcademicYear::where('active', 1)->first();

        $e_setting = EnrollmentSetting::find(1);

        return view('admin.enrollment', ['programs' => $programs, 'courses' => $courses, 'yl' => $yl, 'ay' => $ay, 'es' => $e_setting]);
    }


    // method use to save active enrollment
    public function postSaveEnrollment(Request $request)
    {

        // check if enrollment is active
        $es = EnrollmentSetting::find(1);

        if($es->status == 0) {
            return redirect()->back()->with('setting_error', 'Enrollment Off. Please turn it On!');
        }

        // check if there is an active academic year
        $check_ay = AcademicYear::where('active', 1)->first();

        if(count($check_ay) < 1) {
            return redirect()->back();
        }


        $request->validate([
            'program' => 'required|array|min:2|max:2',
            'course' => 'required|array|min:1',
            'year_level' => 'required'
        ]);

        // assign to variables
        $progs[] = $request['program'];
        $cours[] = $request['course'];
        $year_level = $request['year_level'];


        // make all active enroll as inactive active=0
        Course::where('active', 1)->update(['active' => 0]);
        Program::where('active', 1)->update(['active' => 0]);
        YearLevel::where('active', 1)->update(['active' => 0]);

        // get all programs and courses
        foreach($progs as $p)
            $programs = Program::find($p);

        foreach($cours as $c)
            $courses = Course::find($c);


        foreach($programs as $program) {
            $program->active = 1;
            $program->save();
        }

        foreach($courses as $course) {
            $course->active = 1;
            $course->save();
        }

        $yl = YearLevel::findorfail($year_level);
        $yl->active = 1;
        $yl->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Set Enrollment Active');

        // return to dashboard
        return redirect()->route('admin.dashboard');
        
    }


    // method use to save enrollment setting
    public function postenrollmentSetting(Request $request)
    {

        $setting = $request['enrollment_switch'];
        $status = null;

        if($setting == 'on') {
            $status = 'On';
            $setting = 1;
        }
        else {
            $status = 'Off';
            $setting = 0;
        }

        $es = EnrollmentSetting::find(1);
        $es->status = $setting;
        $es->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Set Enrollment On/Off');

         return redirect()->back()->with('setting_success', 'Enrollment Setting: ' . $status);

    }


    // method use to view assessments
    public function viewAssessments()
    {
        $assessments = Assessment::where('active', 1)
                                ->orderBy('created_at', 'asc')
                                ->paginate(15);

        return view('admin.assessments', ['assessments' => $assessments]);
    }


    // method use to view assessment details
    public function viewAssessemntDetails($id = null)
    {
        $assessment = Assessment::findorfail($id);

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

        return view('admin.assessment-details', ['assessment' => $assessment, 'subjects' => $subjects]);
    }


    // method use to view payment
    public function viewPaypalPayments()
    {
        $payments = Payment::orderBy('created_at', 'desc')
                            ->paginate(15);

        return view('admin.payments', ['payments' => $payments]);
    }

}
