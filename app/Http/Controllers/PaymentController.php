<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

use Auth;
use App\Http\Controllers\GeneralController;
use App\EnrollmentStatus;
use App\AcademicYear;
use App\ActiveSemester;
use App\YearLevel;
use App\Assessment;
use App\Payment as PaymentTable;
use App\SubjectStudent;
use App\StudentPerSubject;
use App\Subject;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }


    public function payWithpaypal(Request $request)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Tuition & Miscellaneous Fee') /** item name **/
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Assessment Payment to ICT Online Enrollment. Assessment Number:' . $request->get('code'));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('student.payment.status')) /** Specify return URL **/
            ->setCancelUrl(route('student.payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return redirect()->route('student.dashboard');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return redirect()->route('student.dashboard');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            // \Session::put('error', 'Payment failed');
            return redirect()->route('student.dashboard')->with('error', 'Error in Payment!');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            // \Session::put('success', 'Payment success');

            // save the status of the payment of assessment
            // make all operations here
            // this point the payment operation is successful
            // assessment status to paid
            // add enrollement status to the student
            $payment_id = $result->getId(); // paypal payment id to save in payment table in the database

            $ay = AcademicYear::where('active', 1)->first();
            $yl = YearLevel::where('active', 1)->first();
            $sem = ActiveSemester::where('active', 1)->first();


            // run only when there is no sy in the info
            if(Auth::user()->info->school_year_admitted == null) {
               Auth::user()->info->school_year_admitted = $ay->id;
                Auth::user()->info->save();
            }

            $assessment = Assessment::where('student_id', Auth::user()->id)
                                ->where('active', 1)
                                ->first();
            $assessment->paid = 1;
            $assessment->save();

            $enroll = new EnrollmentStatus();
            $enroll->student_id = Auth::user()->id;
            $enroll->assessment_id = $assessment->id;
            $enroll->academic_year_id = $ay->id;
            $enroll->semester_id = $sem->id;
            $enroll->year_level_id = $yl->id;
            if($assessment->course_id != null) {
                $enroll->course_id = $assessment->course_id;
            }
            else {
                $enroll->program_id = $assessment->program_id;
            }
            $enroll->save();

            // add to student_subjects_sections
            // check for limit to change number of group just in case
            $student_limit = StudentPerSubject::find(1);

            if(Auth::user()->info->enrolling_for == 1) {
                // get all subjects in assessment
                $assessment_subjects_ids = $assessment->subject_ids;

                $subjects = null;
                
                foreach(unserialize($assessment_subjects_ids) as $id) {
                    $subjects = Subject::find($id);
                }

                foreach($subjects as $sub) {
                
                    // find the last number of enrolled students in a subject
                    $last_student_enrolled = SubjectStudent::where('academic_year_id', $ay->id)
                                        ->where('semester', $sem->id)
                                        ->where('year_level_id', $yl->id)
                                        ->where('subject_id', $sub->id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();

                    // if there is no group number
                    // the system will create a new one
                    if(count($last_student_enrolled) < 1) {
                        $group_number = 1;

                        $new_student = new SubjectStudent();
                        $new_student->student_id = Auth::user()->id;
                        $new_student->academic_year_id = $ay->id;
                        $new_student->semester = $sem->id;
                        $new_student->year_level_id = $yl->id;
                        $new_student->subject_id = $sub->id;
                        $new_student->group_number = $group_number;
                        $new_student->number_of_students = 1;
                        $new_student->save();
                    }
                    else {
                        // get the last number of student and compare it to the max limit of students per subject section
                        // to decide weather it will create a new group or not
                        if($last_student_enrolled->number_of_students >= $student_limit->limit) {
                            // get the last group number and increment it by 1
                            $group_number = $last_student_enrolled->group_number + 1;

                            $new_student = new SubjectStudent();
                            $new_student->student_id = Auth::user()->id;
                            $new_student->academic_year_id = $ay->id;
                            $new_student->semester = $sem->id;
                            $new_student->year_level_id = $yl->id;
                            $new_student->subject_id = $sub->id;
                            $new_student->group_number = $group_number;
                            $new_student->number_of_students = 1;
                            $new_student->save();

                        }
                        else {
                            // get the last number of student number
                            $last_number = $last_student_enrolled->number_of_students + 1;
                            $group_number = $last_student_enrolled->group_number;

                            $new_student = new SubjectStudent();
                            $new_student->student_id = Auth::user()->id;
                            $new_student->academic_year_id = $ay->id;
                            $new_student->semester = $sem->id;
                            $new_student->year_level_id = $yl->id;
                            $new_student->subject_id = $sub->id;
                            $new_student->group_number = $group_number;
                            $new_student->number_of_students = last_number;
                            $new_student->save();
                        }
                    }

                }
                
            }




            // add to payment
            $payment = new PaymentTable();
            $payment->student_id = Auth::user()->id;
            $payment->payment_id = $payment_id;
            $payment->assessment_id = $assessment->id;
            $payment->amount = $assessment->total;
            $payment->save();

            // add activity log
            GeneralController::activity_log(Auth::user()->id, 5, 'Student Paid Assessment');

            // return Redirect::to('/');
            return redirect()->route('student.dashboard')->with('success', 'Payment Successful!');

        }

        // \Session::put('error', 'Payment failed');
        // return Redirect::to('/');
        return redirect()->route('student.dashboard')->with('error', 'Error in Payment!');

    }

}
