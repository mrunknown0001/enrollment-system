<?php

Route::get('/', 'LoginController@welcome')->name('welcome');


Route::get('/student/login', 'LoginController@login')->name('student.login');


Route::post('/student/login', 'LoginController@postLogin')->name('student.login.post');

// redirect to student login form
Route::get('/student', function () {
	return redirect()->route('student.login');
});

Route::get('/login', function () {
	return redirect()->route('student.login');
})->name('login');


Route::get('/faculty/login', 'FacultyLoginController@login')->name('faculty.login');

Route::post('/faculty/login', 'FacultyLoginController@postLogin')->name('faculty.login.post');

// redirect to faculty login form
Route::get('/faculty', function () {
	return redirect()->route('faculty.login');
});


Route::get('/cashier/login', 'CashierLoginController@login')->name('cashier.login');

Route::post('/cashier/login', 'CashierLoginController@postLogin')->name('cashier.login.post');

// redirect to cashier login form
Route::get('/cashier', function () {
	return redirect()->route('cashier.login');
});


Route::get('/registrar/login', 'RegistrarLoginController@login')->name('registrar.login');

Route::post('/registrar/login', 'RegistrarLoginController@postLogin')->name('registrar.login.post');

// redirect to registrar login form
Route::get('/registrar', function () {
	return redirect()->route('registrar.login');
});


Route::get('/admin/login', 'AdminLoginController@login')->name('admin.login');

Route::post('/admin/login', 'AdminLoginController@postLogin')->name('admin.login.post');

// redirect to admin login
Route::get('/admin', function () {
	return redirect()->route('admin.login');
});


Route::get('/student/registration', 'RegistrationController@registration')->name('student.registration');


Route::post('/student/registration', 'RegistrationController@postRegistration')->name('student.registration.post');


Route::get('/faculty/registration', 'FacultyRegistrationController@registration')->name('faculty.registration');


Route::post('/faculty/registration', 'FacultyRegistrationController@postRegistration')->name('faculty.registration.post');


Route::get('/logout', 'GeneralController@logout')->name('logout');


/*
 * Student Route Group 
 * controller protected middleware
 * user type 5
 */
Route::group(['prefix' => 'student'], function () {
	// student dashboard
	Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');

	// rotue to view profile of the student
	Route::get('/profile', 'StudentController@profile')->name('student.profile');

	// route to view profile update
	Route::get('/profile/update', 'StudentController@updateProfile')->name('student.profile.update');

	// route to update profile
	Route::post('/profile/update', 'StudentController@postUpdateProfile')->name('student.profile.update.post');

	// route to view change password form
	Route::get('/password/change', 'StudentController@changePassword')->name('student.password.change');

	// rotue to save change password
	Route::post('/password/change', 'StudentController@postChangePassword')->name('student.password.change.post');

	// route to save what to enroll
	Route::post('/enrollment/for', 'StudentController@postEnrollmentFor')->name('student.enrollment.for.post');

	// route to save year level of the student
	Route::post('/year-level/select', 'StudentController@postYearLevel')->name('student.year.level.select.post');

	// route to view grades current and previous in course
	Route::get('/grades', 'StudentController@viewGrades')->name('student.grades');

	// route to view subjects
	Route::get('/subjects', 'StudentController@viewSubjects')->name('student.subjects');

	// route to view remarks 
	Route::get('/remarks', 'StudentController@viewRemarks')->name('student.remarks');

	// route to view program enrolled
	Route::get('/program/enrolled', 'StudentController@viewProgram')->name('student.programs');

	// rotue to enrollment: setting of course/program to enroll
	Route::get('/enroll', 'StudentController@viewEnroll')->name('student.enroll');

	// route to save enroll assessment in program
	Route::post('/enroll/program', 'StudentController@postEnrollProgram')->name('student.enroll.program.post');

	// route to save course in info
	Route::post('/enroll/course', 'StudentController@postEnrollCourse')->name('student.enroll.course.post');

	// route to save subject in assessment
	Route::post('/enroll/course/subject', 'StudentController@postEnrollCourseSubject')->name('student.enroll.course.subject.post');

	// route to view assessment
	Route::get('/assessment', 'StudentController@viewAssessment')->name('student.assessment');

	// route to pay with paypal
	Route::post('/pay/with/paypal', 'PaymentController@payWithpaypal')->name('student.pay.with.paypal.post');

	// route to redirect after the payment is successful
	Route::get('/payment/status', 'PaymentController@getPaymentStatus')->name('student.payment.status');

	// route to view payments
	Route::get('/payments', 'StudentController@viewPayments')->name('students.payments');

});


/*
 * Registrar Route Group
 * user type 4
 */
Route::group(['prefix' => 'registrar'], function () {
	// registrar dashboard
	Route::get('/dashboard', 'RegistrarController@dashboard')->name('registrar.dashboard');

	// route use toview profile
	Route::get('/profile', 'RegistrarController@profile')->name('registrar.profile');

	// rotue use to view profile update form
	Route::get('/profile/update', 'RegistrarController@updateProfile')->name('registrar.profile.update');

	// route use to update profile of registrar
	Route::post('/profile/update', 'RegistrarController@postUpdateProfile')->name('registrar.profile.update.post');

	// rotue use to view password change form
	Route::get('/password/change', 'RegistrarController@changePassword')->name('registrar.password.change');

	// route to change password of registrar
	Route::post('/password/change', 'RegistrarController@postChangePassword')->name('registrar.password.change.post');

	// route to view students
	Route::get('/students', 'RegistrarController@viewStudents')->name('registrar.view.students');

	// route to view courses 
	Route::get('/courses', 'RegistrarController@viewCourses')->name('registrar.view.courses');

	// rotue to view course year level
	Route::get('/course/{id}/year-level', 'RegistrarController@viewCourseYearLevel')->name('registrar.view.course.year.level');

	// rotue to view students in a course in year level
	Route::get('/course/{course_id}/year-level/{yl_id}/students/enrolled', 'RegistrarController@viewCourseYearLevelEnrolled')->name('registrar.view.course.year.level.enrolled');

	// route to view programs
	Route::get('/programs', 'RegistrarController@viewPrograms')->name('registrar.view.programs');

	// rotue to view programs enrolled students
	Route::get('/program/{id}/students/enrolled', 'RegistrarController@viewProgramEnrolled')->name('registrar.view.program.enrolled');

	// route to view student info
	Route::get('/student/{id}/{sn}/details', 'RegistrarController@viewStudentDetails')->name('registrar.view.student.details');

	// route to search students
	Route::get('/students/search', 'RegistrarController@searchStudent')->name('registrar.search.students');
});



/*
 * Cashier Route Group
 * user type 3
 */
Route::group(['prefix' => 'cashier'], function () {
	// cashier dashboard
	Route::get('/dashboard', 'CashierController@dashboard')->name('cashier.dashboard');

	// route to cashier profile
	Route::get('/profile', 'CashierController@profile')->name('cashier.profile');

	// route to view updte profile
	Route::get('/profile/update', 'CashierController@updateProfile')->name('cashier.profile.update');

	// route to update profile of cashier
	Route::post('/profile/update', 'CashierController@postUpdateProfile')->name('cashier.profile.update.post');

	// route to show password update
	Route::get('/password/change', 'CashierController@changePassword')->name('cashier.password.change');

	// route to update password
	Route::post('/password/change', 'CashierController@postChangePassword')->name('cashier.password.change.post');

	// route to show students page with search
	Route::get('/students', 'CashierController@viewStudents')->name('cashier.view.students');

	// route to show search result in students
	Route::get('/students/search', 'CashierController@searchStudents')->name('cashier.search.students');

	// route to view active assessment of students
	Route::get('/student/{id}/assessment', 'CashierController@viewStudentAssessment')->name('cashier.view.student.assessment');

	// route to view assessments
	Route::get('/assessments', 'CashierController@viewAssessments')->name('cashier.view.assessments');

	// route to view assessment details
	Route::get('/assessment/{id}/details', 'CashierController@viewAssessmentDetails')->name('cashier.view.assessment.details');

	// route to view payment
	Route::get('/payments', 'CashierController@viewPayments')->name('cashier.view.payments');
});


/*
 * Faculty Route Group
 * user type 2
 */
Route::group(['prefix' => 'faculty'], function () {
	// faculty dashboard
	Route::get('/dashboard', 'FacultyController@dashboard')->name('faculty.dashboard');

	// route to view faculty profile
	Route::get('/profile', 'FacultyController@profile')->name('faculty.profile');

	// route to view faculty form update
	Route::get('/profile/update', 'FacultyController@updateProfile')->name('faculty.profile.update');

	// route to update faculty form
	Route::post('/profile/update', 'FacultyController@postUpdateProfile')->name('faculty.profile.update.post');

	// rotue view password change form
	Route::get('/password/change', 'FacultyController@changePassword')->name('faculty.password.change');

	// rotue to save change password of faculty
	Route::post('/password/change', 'FacultyController@postChangePassword')->name('faculty.password.change.post');

	// rotue to view subjects assignment to a faculty
	Route::get('/subjects/assignments', 'FacultyController@viewSubjectAssignments')->name('faculty.view.subject.assignments');

	// route to view program load of the faculty
	Route::get('/programs/assignments', 'FacultyController@viewProgramAssignments')->name('faculty.view.program.assignments');
});


/*
 * Admin Route Group
 * controller protected middleware
 * user type 1
 */
Route::group(['prefix' => 'admin'], function () {
	// admin dashboard
	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	// route to view admin profile
	Route::get('/profile', 'AdminController@profile')->name('admin.profile');

	// rotue to view update profile
	Route::get('/profile/update', 'AdminController@profielUpdate')->name('admin.profile.update');

	// rotue to update profile
	Route::post('/profile/update', 'AdminController@postProfileUpdate')->name('admin.profile.update.post');

	// rotue to change password view
	Route::get('/password/change', 'AdminController@changePassword')->name('admin.change.password');

	// route to change password of admin
	Route::post('/password/change', 'AdminController@postChangePassword')->name('admin.change.password.post');

	// rotue to view activity logs
	Route::get('/activity/logs', 'AdminController@activityLog')->name('admin.activity.logs');

	// route to view cashiers and other operations
	Route::get('/users/cashiers', 'AdminController@viewCashiers')->name('admin.view.cashiers');

	// route to reset password for cashier in default
	Route::post('/users/cashier/reset/password', 'AdminController@postResetCashierPassword')->name('admin.reset.cashier.password.post');

	// route to view add cashier form
	Route::get('/users/cashier/add', 'AdminController@addCashier')->name('admin.add.cashier');

	// route to add save new cashier to database
	Route::post('/users/cashier/add', 'AdminController@postAddCashier')->name('admin.add.cashier.post');

	// route to view all registrar
	Route::get('/users/registrars', 'AdminController@viewRegistrars')->name('admin.view.registrars');

	// route to reset registrar default password
	Route::post('/users/registrar/reset/password', 'AdminController@postResetRegistrarPassword')->name('admin.reset.registrar.password.post');

	// route to view add registrar form
	Route::get('/users/registrar/add', 'AdminController@addRegistrar')->name('admin.add.registrar');

	// route to add save new registrars
	Route::post('/users/registrar/add', 'AdminController@postAddRegistrar')->name('admin.add.registrar.post');

	// route to view faculty
	Route::get('/users/faculties', 'AdminController@viewFaculties')->name('admin.view.faculties');

	// route to view faculty details
	Route::get('/users/faculty/{id}/details', 'AdminController@viewFacultyDetails')->name('admin.view.faculty.details');

	// route to add loads to faculty
	Route::get('/user/faculty/{id}/load/add', 'AdminController@addLoadFaculty')->name('admin.add.load.faculty');

	// route to select subjects and add load to faculty
	Route::get('/user/faculty/{id}/load/subjects/add', 'AdminController@addSubjectLoadFaculty')->name('admin.add.subject.load.faculty');

	// route to save subject to a faculty
	Route::post('/user/faculty/load/subject/add', 'AdminController@postAddSubjectLoadFaculty')->name('admin.add.subject.load.faculty.post');

	// route to add program load to faculty
	Route::get('/user/faculty/{id}/load/program/add', 'AdminController@addProgramLoadFaculty')->name('admin.add.program.load.faculty');

	// rotue to save program load to faculty
	Route::post('/user/faculty/load/program/add', 'AdminController@postAddProgramLoadFaculty')->name('admin.add.program.load.faculty.post');

	// route to update load in faculty


	// route to view programs available
	Route::get('/programs', 'AdminController@viewPrograms')->name('admin.view.programs');

	// route to view add program
	Route::get('/program/add', 'AdminController@addProgram')->name('admin.add.program');

	// route to add program
	Route::post('/program/add', 'AdminController@postAddProgram')->name('admin.add.program.post');

	// route to update form of the program
	Route::get('/program/{id}/update/', 'AdminController@updateProgram')->name('admin.update.program');

	// route to save update of program
	Route::post('/program/update', 'AdminController@postUpdateProgram')->name('admin.update.program.post');

	// route to view courses
	Route::get('/courses', 'AdminController@viewCourses')->name('admin.courses');

	// route to add course
	Route::get('/course/add', 'AdminController@addCourse')->name('admin.add.course');

	// route to save course
	Route::post('/course/add', 'AdminController@postAddCourse')->name('admin.add.course.post');

	// route to view update form of course
	Route::get('/course/{id}/update', 'AdminController@updateCourse')->name('admin.update.course');

	// route to save update of the course
	Route::post('/course/update', 'AdminController@postUpdateCourse')->name('admin.update.course.post');

	// route to show subjects
	Route::get('/subjects', 'AdminController@viewSubjects')->name('admin.subjects');

	// route to add subject 
	Route::get('/subject/add', 'AdminController@addSubject')->name('admin.add.subject');

	// route to add subject
	Route::post('/subject/add', 'AdminController@postAddSubject')->name('admin.add.subject.post');

	// route to view update form of subjects
	Route::get('/subject/{id}/update', 'AdminController@updateSubject')->name('admin.update.subject');

	// route to save update of the subject
	Route::post('/subject/update', 'AdminController@postUpdatesubject')->name('admin.update.subject.post');

	// route to update price per unit
	Route::get('/subject/unit/price/update', 'AdminController@pricePerUnitUpdate')->name('admin.price.per.unit.update');

	// route to save update price unit
	Route::post('/subject/unit/price/update', 'AdminController@postPricePerUnitUpdate')->name('admin.price.per.unit.update.post');

	// route to select subjects
	Route::get('/subjects/select', 'AdminController@selectSubjects')->name('admin.select.subjects');

	// rotue to save select subjects in enrollment
	Route::post('/subjects/select', 'AdminController@postSelectSubjects')->name('admin.select.subjects.post');

	// route to view all students
	Route::get('/students', 'AdminController@viewStudents')->name('admin.students');

	// route to search for students
	Route::get('/students/searhResult', 'AdminController@searchStudent')->name('admin.student.search');

	// route to view year levels
	Route::get('/year-levels', 'AdminController@viewYearLevels')->name('admin.view.year.level');

	// route to view add year level form
	Route::get('/year-level/add', 'AdminController@addYearLevel')->name('admin.add.year.level');

	// rotue ot save new year Level
	Route::post('/year-level/add', 'AdminController@postAddYearLevel')->name('admin.add.year.level.post');

	// rotue to view update form year level
	Route::get('/year-level/{id}/update', 'AdminController@updateYearLevel')->name('admin.update.year.level');

	// route to save update on year level
	Route::post('/year-level/update', 'AdminController@postUpdateYearLevel')->name('admin.update.year.level.post');

	// route to view and other operation in academic year
	Route::get('/academic-year', 'AdminController@viewAcademicYear')->name('admin.academic.year');


	// route to add academic year
	Route::get('/academic-year/add', 'AdminController@addAcademicYear')->name('admin.add.academic.year');


	// route to add save academic year
	Route::post('/academic-year/add', 'AdminController@postAddAcademicYear')->name('admin.add.academic.year.post');

	// rotue to close academic year
	Route::post('/academic-year/close', 'AdminController@postCloseAcademicYear')->name('admin.close.academic.year.post');


	// route to set semester
	Route::post('/semester/set', 'AdminController@postSetSemester')->name('admin.set.semester.post');

	// route to set next semester
	Route::get('/semester/set/active/{id}', 'AdminController@setSemester')->name('admin.set.semester');

	// route to view settings in rates and fees
	Route::get('/rates-fees/settings', 'AdminController@viewRateFeeSettings')->name('admin.rate.fee.settings');

	// rotue to add misc fee form
	Route::get('/rates-fees/add', 'AdminController@addMiscFee')->name('admin.add.misc.fee');


	// route to edit msic fee
	Route::get('/rates-fees/{id}/update', 'AdminController@updateMiscFee')->name('admin.update.misc.fee');

	// route to save updte on misc fee
	Route::post('/rates-fees/update', 'AdminController@postUpdateMiscFee')->name('admin.update.misc.fee.post');

	// route to delete misc fee
	Route::get('/rates-fees/delete/{id}', 'AdminController@deleteMiscFee')->name('admin.delete.misc.fee');

	// route to add misc fee
	Route::post('/rates-fees/add', 'AdminController@postAddMiscFee')->name('admin.add.misc.fee.post');

	// route to veiw settings in enrollment
	Route::get('/enrollment', 'AdminController@enrollment')->name('admin.enrollment');

	// route to save active enroll option
	Route::post('/enrollment', 'AdminController@postSaveEnrollment')->name('admin.save.enrollment.post');

	// route to view assessments
	Route::get('/assessments', 'AdminController@viewAssessments')->name('admin.view.assessments');

	// route to view assessment details
	Route::get('/assessment/{id}/details', 'AdminController@viewAssessemntDetails')->name('admin.view.assessment.details');

	// route to view payments in paypal
	Route::get('/paypal/payments', 'AdminController@viewPaypalPayments')->name('admin.view.payments');
});