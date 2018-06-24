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
        $students = User::get();


    	return view('admin.dashboard', ['students' => $students]);
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
        return redirect()->route('admin.add.cashier');

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
        return redirect()->route('admin.add.registrar');

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

        // returm message
        return redirect()->route('admin.courses')->with('success', 'Course Updated!');

    }


    // method use to view all subjects
    public function viewSubjects()
    {
        $subjects = Subject::orderBy('title', 'asc')
                        ->paginate(15);

        return view('admin.subjects', ['subjects' => $subjects]);
    }


    // method use  to view add subject form
    public function addSubject()
    {
        return view('admin.add-subject');
    }


    // method use to save added subject
    public function postAddsubject(Request $request)
    {
        // validate request data
        $request->validate([
            'title' => 'required|unique:subjects',
            'code' => 'required|unique:subjects',
            'units' => 'required'
        ]);

        // assing to variables
        $title = $request['title'];
        $code = $request['code'];
        $desc = $request['description'];
        $units = $request['units'];

        // save
        $subject = new Subject();
        $subject->title = $title;
        $subject->code = $code;
        $subject->description = $desc;
        $subject->units = $units;
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

        return view('admin.update-subject', ['subject' => $subject]);
    }


    // method use to save update in subject
    public function postUpdatesubject(Request $request)
    {
        // validate request data
        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'units' => 'required'
        ]);

        // assing to variables
        $id = $request['id'];
        $title = $request['title'];
        $code = $request['code'];
        $desc = $request['description'];
        $units = $request['units'];

        $subject = Subject::findorfail($id);

        // check title and code manual
        if($subject->title != $title) {
            if(Subject::where('title', $title)->exists()) {
                return redirect()->route('admin.update.subject', ['id' => $subject->id])->with('error', 'Title Already Exist!');
            }
        }

        if($subject->code != $code) {
            if(Subject::where('code', $code)->exists()) {
                return redirect()->route('admin.update.subject', ['id' => $subject->id])->with('error', 'Code Already Exist!');
            }
        }


        // save
        $subject->title = $title;
        $subject->code = $code;
        $subject->description = $desc;
        $subject->units = $units;
        $subject->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Subject');

        // return with message
        return redirect()->route('admin.subjects')->with('success', 'Subject Update Success!');

    }


    // method use to view all students
    public function viewStudents()
    {
        // get all active and enrolled students
        $students = User::orderBy('lastname', 'asc')
                        ->paginate(10);

        return view('admin.students', ['students' => $students]);
    }



}
