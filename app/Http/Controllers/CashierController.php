<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Cashier;
use App\Assessment;
use App\Subject;
use App\Payment;
use App\User;
use App\ActivityLog;
use App\EnrollmentSetting;

use App\Http\Controllers\GeneralController;

class CashierController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth:cashier');
    }

    // method use to view cashier dashboard
    public function dashboard()
    {
        $students = User::get(['id']);

        $es = EnrollmentSetting::find(1);

        // get total payment of the current enrollment
        $payments = Payment::where('status', 1)->get();
        $total_payment = null;

        foreach($payments as $p) {
            $total_payment += $p->amount;
        }

    	return view('cashier.dashboard', ['students' => $students, 'es' => $es, 'total_payment' => $total_payment]);
    }

    // method use to view profile of the cashier
    public function profile()
    {
        return view('cashier.profile');
    }


    // method use to view profile update form
    public function updateProfile()
    {
        return view('cashier.profile-update');
    }


    // method use to update profile
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

        $cashier = Cashier::findorfail(Auth::guard('cashier')->user()->id);
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->id_number = $id;
        $cashier->mobile_number = $mobile;
        $cashier->save();


        // add activity log
        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Update Cashier Profile');

        // return message
        return redirect()->route('cashier.profile')->with('success', 'Profile Updated!');
    }

    // method use to password
    public function changePassword()
    {
        return view('cashier.change-password');
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
        if(password_verify($old, Auth::guard('cashier')->user()->password)) {
            // change the password
            $cashier = Cashier::findorfail(Auth::guard('cashier')->user()->id);
            $cashier->password = bcrypt($new);
            $cashier->save();

            // activity log
            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Cashier Change Password');

            return redirect()->route('cashier.password.change')->with('success', 'Password Changed!');
        }

        return redirect()->route('cashier.password.change')->with('error', 'Old Password Invalid!');
    }


    // method use to view students
    public function viewStudents()
    {
        return view('cashier.students');
    }


    // method use to show result in student search
    public function searchStudents(Request $request)
    {
        $keyword = $request['keyword'];

        $students = GeneralController::students_search($keyword);

        return view('cashier.students-search', ['students' => $students]);
    }


    // method use to show assessment of the student in any
    public function viewStudentAssessment($id = null)
    {
        $student = User::findorfail($id);

        $assessment = Assessment::where('student_id', $student->id)
                                ->where('active', 1)
                                ->first();

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

        return view('cashier.assessment-details', ['assessment' => $assessment, 'subjects' => $subjects]);
    }


    // method use to view assessments
    public function viewAssessments()
    {
        $assessments = Assessment::where('active', 1)
                                ->orderBy('created_at', 'asc')
                                ->paginate(15);

        return view('cashier.assessments', ['assessments' => $assessments]);
    }


    // method use to view assessment details
    public function viewAssessmentDetails($id = null)
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

        return view('cashier.assessment-details', ['assessment' => $assessment, 'subjects' => $subjects]);
    }


    // method use to view payments
    public function viewPayments()
    {
        $payments = Payment::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('cashier.payments', ['payments' => $payments]);
    }


    // method use to make payment
    public function makePayment($id = null)
    {
        $student = User::findorfail($id);

        return view('cashier.payments-make-payment', ['student' => $student]);
    }


    // method use to save make payment
    public function postMakePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);

        $id = $request['id'];

        $amount = $request['amount'];

        $student = User::findorfail($id);

        // deduct the amount in the balance
        $student->balance->balance -= $amount;
        $student->balance->save();

        $assessment = Assessment::where('student_id', $student->id)->first();
        $assessment->total -= $amount;

        if($assessment->total < 1) {
            $assessment->paid = 1;
        }

        $assessment->save();

        //add to payment
        $payment = new Payment();
        $payment->student_id = $student->id;
        $payment->amount = $amount;
        $payment->payment_id = 'Over the Counter';
        $payment->assessment_id = $assessment->id;
        $payment->save();

        // add to report

        // return back
        return redirect()->back()->with('success', 'Payment Successfull!');
    }

}
