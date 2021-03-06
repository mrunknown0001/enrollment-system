<?php

Route::group(['middleware' => 'prevent-back-history'], function () {

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

	// route to forgot password
	Route::get('/forgot-password', 'LoginController@forgotPassword')->name('student.forgot.password');

	// route to find student with student number
	Route::post('/forgot-password', 'LoginController@postForgotPassword')->name('student.forgot.password.post');

	// route to reset password
	Route::post('/password-reset', 'LoginController@postPasswordReset')->name('student.password.reset.post');

	Route::get('/password-reset', function () {
		return redirect()->route('student.forgot.password');
	});

	Route::post('/password/new', 'LoginController@postPasswordNew')->name('student.new.password.post');

	Route::get('/password/new', function () {
		return redirect()->route('student.forgot.password');
	});

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



	Route::get('/faculty/registration', 'FacultyRegistrationController@registration')->name('faculty.registration');


	Route::post('/faculty/registration', 'FacultyRegistrationController@postRegistration')->name('faculty.registration.post');

});

Route::get('/data-privacy-statement', function() {
	return view('data-privacy-statement');
})->name('data.privacy.statement');


Route::get('/logout', 'GeneralController@logout')->name('logout');


/*
 * Student Route Group 
 * controller protected middleware
 * user type 5
 */
Route::group(['prefix' => 'student', 'middleware' => 'prevent-back-history'], function () {
	// student dashboard
	Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');

	// route to view profile of the student
	Route::get('/profile', 'StudentController@profile')->name('student.profile');

	// route to view profile update
	Route::get('/profile/update', 'StudentController@updateProfile')->name('student.profile.update');

	// route to update profile
	Route::post('/profile/update', 'StudentController@postUpdateProfile')->name('student.profile.update.post');

	// route to upload profile image
	Route::post('/profile/image', 'StudentController@postUploadProfileImage')->name('student.upload.profile.image.post');

	// route to view change password form
	Route::get('/password/change', 'StudentController@changePassword')->name('student.password.change');

	// route to save change password
	Route::post('/password/change', 'StudentController@postChangePassword')->name('student.password.change.post');

	// route to save what to enroll
	Route::post('/enrollment/for', 'StudentController@postEnrollmentFor')->name('student.enrollment.for.post');

	// route to cancel enrolling for
	Route::get('/enrollment/cancel', 'StudentController@cancelEnrollmentFor')->name('student.cancel.enrollment.for');

	// route to save year level of the student
	Route::post('/year-level/select', 'StudentController@postYearLevel')->name('student.year.level.select.post');

	// route to view grades current and previous in course
	Route::get('/grades', 'StudentController@viewGrades')->name('student.grades');

	// route to view grades of subject
	Route::get('/grades/subject/{id}/view', 'StudentController@viewSubjectGrades')->name('student.view.subject.grades');

	// routeto view all grades in all subjects
	Route::get('/grades/subjects', 'StudentController@viewStudentGradesSubjects')->name('student.view.student.grades.subjects');

	// route to view subjects
	Route::get('/subjects', 'StudentController@viewSubjects')->name('student.subjects');

	// route to view remarks 
	Route::get('/remarks', 'StudentController@viewRemarks')->name('student.remarks');

	// route to view program enrolled
	Route::get('/program/enrolled', 'StudentController@viewProgram')->name('student.programs');

	// route to enrollment: setting of course/program to enroll
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
Route::group(['prefix' => 'registrar', 'middleware' => 'prevent-back-history'], function () {
	// registrar dashboard
	Route::get('/dashboard', 'RegistrarController@dashboard')->name('registrar.dashboard');

	// route use toview profile
	Route::get('/profile', 'RegistrarController@profile')->name('registrar.profile');

	// route use to view profile update form
	Route::get('/profile/update', 'RegistrarController@updateProfile')->name('registrar.profile.update');

	// route use to update profile of registrar
	Route::post('/profile/update', 'RegistrarController@postUpdateProfile')->name('registrar.profile.update.post');

	// route use to view password change form
	Route::get('/password/change', 'RegistrarController@changePassword')->name('registrar.password.change');

	// route to change password of registrar
	Route::post('/password/change', 'RegistrarController@postChangePassword')->name('registrar.password.change.post');

	// route to view students
	Route::get('/students', 'RegistrarController@viewStudents')->name('registrar.view.students');

	Route::get('/student/registration', 'RegistrationController@registration')->name('registrar.student.registration');


	Route::post('/student/registration', 'RegistrationController@postRegistration')->name('registrar.student.registration.post');

	// route to view courses 
	Route::get('/courses', 'RegistrarController@viewCourses')->name('registrar.view.courses');

	// route to view course year level
	Route::get('/course/{id}/year-level', 'RegistrarController@viewCourseYearLevel')->name('registrar.view.course.year.level');

	// route to view students in a course in year level
	Route::get('/course/{course_id}/year-level/{yl_id}/students/enrolled', 'RegistrarController@viewCourseYearLevelEnrolled')->name('registrar.view.course.year.level.enrolled');

	// route to view grades of students 
	Route::get('/course/{id}/student/{sid}/grades', 'RegistrarController@viewCourseStudentGrades')->name('registrar.view.course.student.grades');

	// route to update student grades in a subject
	Route::get('/course/{id}/student/{student_id}/subject/{subject_id}/grades/update', 'RegistrarController@updateStudentSubjectGrades')->name('registrar.update.student.subject.grades');

	// route to update student grades in a subject
	Route::post('/course/student/subject/grades/update', 'RegistrarController@postUpdateStudentSubjectGrades')->name('registrar.update.student.subject.grades.post');

	// route to view programs
	Route::get('/programs', 'RegistrarController@viewPrograms')->name('registrar.view.programs');

	// route to view programs enrolled students
	Route::get('/program/{id}/students/enrolled', 'RegistrarController@viewProgramEnrolled')->name('registrar.view.program.enrolled');

	// route to view remarks of students in program
	Route::get('/student/{id}/program/{pid}/remarks', 'RegistrarController@viewStudentProgramRemarks')->name('registrar.view.student.program.remarks');

	// route to update student remarks in a program
	Route::get('/student/{id}/program/{pid}/remarks/update', 'RegistrarController@updateStudentProgramRemarksUpdate')->name('registrar.update.student.program.remarks');

	// rotue to save update student remark in a program
	Route::post('/student/program/remarks/update', 'RegistrarController@postUpdateStudentProgramRemarksUpdate')->name('registrar.update.student.program.remarks.post');

	// route to view student info
	Route::get('/student/{id}/{sn}/details', 'RegistrarController@viewStudentDetails')->name('registrar.view.student.details');

	// route to view grades of student
	Route::get('/student/{id}/{sn}/grades', 'RegistrarController@viewStudentGrades')->name('registrar.view.student.grades');

	// route to view student tor
	Route::get('/student/{id}/{sn}/tor', 'RegistrarController@viewStudentTor')->name('registrar.view.student.tor');

	// route to view remarks of students
	Route::get('/student/{id}/{sn}/remarks', 'RegistrarController@viewStudentRemarks')->name('registrar.view.student.remarks');

	// route to search students
	Route::get('/students/search', 'RegistrarController@searchStudent')->name('registrar.search.students');

	// route to add credits to student
	Route::get('/student/{id}/credits/add', 'RegistrarController@studentAddCredits')->name('regitrar.student.add.credits');

	// route to save add credit to student
	Route::post('/student/credits/add', 'RegistrarController@postStudentAddCredits')->name('registrar.student.add.credits.post');

	Route::get('/student/credits/add', function () {
		return abort(404);
	});
});



/*
 * Cashier Route Group
 * user type 3
 */
Route::group(['prefix' => 'cashier', 'middleware' => 'prevent-back-history'], function () {
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

	// route to make payments 
	Route::get('/payments/student/{id}/make/payment', 'CashierController@makePayment')->name('cashier.make.payment');

	// route to save payment
	Route::post('/payments/student/make/payment', 'CashierController@postMakePayment')->name('cashier.make.payment.post');
});


/*
 * Faculty Route Group
 * user type 2
 */
Route::group(['prefix' => 'faculty', 'middleware' => 'prevent-back-history'], function () {
	// faculty dashboard
	Route::get('/dashboard', 'FacultyController@dashboard')->name('faculty.dashboard');

	// route to view faculty profile
	Route::get('/profile', 'FacultyController@profile')->name('faculty.profile');

	// route to view faculty form update
	Route::get('/profile/update', 'FacultyController@updateProfile')->name('faculty.profile.update');

	// route to update faculty form
	Route::post('/profile/update', 'FacultyController@postUpdateProfile')->name('faculty.profile.update.post');

	// route view password change form
	Route::get('/password/change', 'FacultyController@changePassword')->name('faculty.password.change');

	// route to save change password of faculty
	Route::post('/password/change', 'FacultyController@postChangePassword')->name('faculty.password.change.post');

	// route to view subjects assignment to a faculty
	Route::get('/subjects/assignments', 'FacultyController@viewSubjectAssignments')->name('faculty.view.subject.assignments');

	// route to view studetns enrolled in subject
	Route::get('/subject/{id}/students/group', 'FacultyController@viewSubjectStudents')->name('faculty.view.subject.students.group');

	// route to view students in a group
	Route::get('/subject/{id}/students/group/{gid}/enrolled', 'FacultyController@viewSubjectStudentsEnrolled')->name('faculty.subject.students.enrolled');

	// route to encode grades of students
	Route::get('/subject/{id}/students/group/{gid}/encode', 'FacultyController@encodeSubjectStudentsGrade')->name('faculty.encode.subject.students.grade');

	// route to save encoded grades
	Route::post('/subject/students/group/encode', 'FacultyController@postEncodeSubjectStudentsGrade')->name('faculty.encode.subject.students.grade.post');

	// route to view grades of students per subject
	Route::get('/subject/{id}/students/group/{gid}/grades/view', 'FacultyController@viewGradesStudentsSubject')->name('faculty.view.grades.students.subject');

	// route to update individual students grades
	Route::get('/subject/{id}/group/{gid}/student/{sid}/grades/update', 'FacultyController@updateSubjectStudentGrades')->name('faculty.update.subject.student.grades');

	// route to save update in grade of student in a subject
	Route::post('/subject/student/grades/update', 'FacultyController@postUpdateSubjectStuedentGrades')->name('faculty.update.subject.student.grades.post');

	// route to view program load of the faculty
	Route::get('/programs/assignments', 'FacultyController@viewProgramAssignments')->name('faculty.view.program.assignments');

	// route to view students enrolled in a program
	Route::get('/program/{id}/students', 'FacultyController@viewProgramStudents')->name('faculty.view.program.students');

	// route to encode grades of the students in the program
	Route::get('/program/{id}/students/remarks/encode', 'FacultyController@encodeProgramRemarks')->name('faculty.encode.program.remarks');

	// route to save remarks of students in a program
	Route::post('/program/subjects/remarks/encode', 'FacultyController@postEncodeProgramRemarks')->name('faculty.encode.program.remarks.post');

	// route to view remarks of students in a program
	Route::get('/program/{id}/students/remarks/view', 'FacultyController@viewProgramStudentsRemarks')->name('faculty.view.program.students.remarks');

	// route to update remark of students
	Route::get('/program/{id}/students/{sid}/remarks/update', 'FacultyController@updateProgramStudentRemarks')->name('faculty.update.progra.student.remarks');

	// route to save update of remark
	Route::post('/program/student/remarks/update', 'FacultyController@postUpdateProgramStudentRemarks')->name('faculty.update.progra.student.remarks.post');

});


/*
 * Admin Route Group
 * controller protected middleware
 * user type 1
 */
Route::group(['prefix' => 'admin', 'middleware' => 'prevent-back-history'], function () {
	// admin dashboard
	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	// route to view admin profile
	Route::get('/profile', 'AdminController@profile')->name('admin.profile');

	// route to view update profile
	Route::get('/profile/update', 'AdminController@profielUpdate')->name('admin.profile.update');

	// route to update profile
	Route::post('/profile/update', 'AdminController@postProfileUpdate')->name('admin.profile.update.post');

	// route to change password view
	Route::get('/password/change', 'AdminController@changePassword')->name('admin.change.password');

	// route to change password of admin
	Route::post('/password/change', 'AdminController@postChangePassword')->name('admin.change.password.post');

	// route to view activity logs
	Route::get('/activity/logs', 'AdminController@activityLog')->name('admin.activity.logs');

	// route to view cashiers and other operations
	Route::get('/users/cashiers', 'AdminController@viewCashiers')->name('admin.view.cashiers');

	// route to reset password for cashier in default
	Route::post('/users/cashier/reset/password', 'AdminController@postResetCashierPassword')->name('admin.reset.cashier.password.post');

	// route to remove cashier
	Route::post('/users/cashier/remove', 'AdminController@postRemoveCashier')->name('admin.remove.cashier.post');

	// route to view add cashier form
	Route::get('/users/cashier/add', 'AdminController@addCashier')->name('admin.add.cashier');

	// route to add save new cashier to database
	Route::post('/users/cashier/add', 'AdminController@postAddCashier')->name('admin.add.cashier.post');

	// route to view all registrar
	Route::get('/users/registrars', 'AdminController@viewRegistrars')->name('admin.view.registrars');

	// route to reset registrar default password
	Route::post('/users/registrar/reset/password', 'AdminController@postResetRegistrarPassword')->name('admin.reset.registrar.password.post');

	// route to remove registrar 
	Route::post('/users/registrar/remove', 'AdminController@postRemoveRegistrar')->name('admin.remove.registrar.post');

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

	// route to save program load to faculty
	Route::post('/user/faculty/load/program/add', 'AdminController@postAddProgramLoadFaculty')->name('admin.add.program.load.faculty.post');

	// route to update load in faculty
	Route::get('/user/faculty/{id}/load/update', 'AdminController@updateFacultyLoad')->name('admin.update.faculty.load');

	// route to update subject assigned to a faculty
	Route::get('/user/faculty/{id}/load/subjects/update', 'AdminController@updateFacultyLoadSubjects')->name('admin.update.faculty.load.subjects');

	// route to save update on subject assigned
	Route::post('/user/faculty/load/subjects/update', 'AdminController@postUpdateFacultyLoadSubjects')->name('admin.update.faculty.load.subjects.post');
	

	// route to update program assigned to a faculty
	Route::get('/user/faculty/{id}/load/programs/update', 'AdminController@updateFacultyLoadPrograms')->name('admin.update.faculty.load.programs');

	// route to save update program assignment
	Route::post('/user/faculty/load/programs/update', 'AdminController@postUpdateFacultyLoadPrograms')->name('admin.update.faculty.load.programs.post');

	// route to remove faculty
	Route::post('/user/faculty/remove', 'AdminController@postRemoveFaculty')->name('admin.remove.faculty.post');



	// route to curriculum
	Route::get('/curriculum', 'AdminController@curriculum')->name('admin.view.curriculum');

	// Route to view specific curriculum
	Route::get('/curriculum/{id}/view', 'AdminController@viewCurriculum')->name('admin.curriculum.view');

	// route to add curriculum
	Route::get('/curriculum/add', 'AdminController@addCurriculum')->name('admin.add.curriculum');


	// route to save curriculum
	Route::post('/curriculum/add', 'AdminController@postAddCurriculum')->name('admin.add.curriculum.post');

	// route to udpate curriculum
	Route::get('/curriculum/{id}/update', 'AdminController@updateCurriculum')->name('admin.update.curriculum');

	// route to save update on curriculum
	Route::post('/curriculum/update', 'AdminController@postUpdateCurriculum')->name('admin.update.curriculum.post');

	Route::get('/curriculum/update', function() {
		return redirect()->route('admin.view.curriculum');
	});

	// route to view courses and curriculum uner
	Route::get('/curriculum/courses', 'AdminController@curriculumCourses')->name('admin.curriculum.courses');

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

	// route to view active subjects
	Route::get('/subjects/active', 'AdminController@viewActiveSubjects')->name('admin.subjects.active');

	// route to view students enrolled in a subject
	Route::get('/subject/{id}/students/enrolled', 'AdminController@viewEnrolledStudentsSubject')->name('admin.view.enrolled.students.subject');

	// route to manage merge groups in subjects overlapping
	Route::get('/subject/{id}/students/group/manager', 'AdminController@manageSubjectStudentsGroup')->name('admin.manage.subject.students.group');

	// route to save merge groups
	Route::post('/subject/students/group/manager', 'AdminController@postManageSubjectStudentsGroup')->name('admin.manage.subject.students.group.post');

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

	// route to save select subjects in enrollment
	Route::post('/subjects/select', 'AdminController@postSelectSubjects')->name('admin.select.subjects.post');

	// route to view all students
	Route::get('/students', 'AdminController@viewStudents')->name('admin.students');


	// route to set requirements
	Route::post('/student/requirements', 'AdminController@postSaveStudentRequirements')->name('admin.student.requirements.save');

	// route to view student raw grades
	Route::get('/student/{id}/grades/view', 'AdminController@viewStudentGrades')->name('admin.view.student.grades');

	// route to view student remarks
	Route::get('/student/{id}/remarks/view', 'AdminController@viewStudentRemarks')->name('admin.view.student.remarks');

	// routo set max number of student per subject class
	Route::get('/students/set/max/number', 'AdminController@setMaxStudentNumber')->name('admin.set.max.student.number');

	// route to save set max number of student per subject class
	Route::post('/students/set/max/number', 'AdminController@postSetMaxStudentNumber')->name('admin.set.max.student.number.post');

	// route to search for students
	Route::get('/students/searhResult', 'AdminController@searchStudent')->name('admin.student.search');

	// route to view year levels
	Route::get('/year-levels', 'AdminController@viewYearLevels')->name('admin.view.year.level');

	// route to view add year level form
	Route::get('/year-level/add', 'AdminController@addYearLevel')->name('admin.add.year.level');

	// route ot save new year Level
	Route::post('/year-level/add', 'AdminController@postAddYearLevel')->name('admin.add.year.level.post');

	// route to view update form year level
	Route::get('/year-level/{id}/update', 'AdminController@updateYearLevel')->name('admin.update.year.level');

	// route to save update on year level
	Route::post('/year-level/update', 'AdminController@postUpdateYearLevel')->name('admin.update.year.level.post');

	// route to view and other operation in academic year
	Route::get('/academic-year', 'AdminController@viewAcademicYear')->name('admin.academic.year');


	// route to add academic year
	Route::get('/academic-year/add', 'AdminController@addAcademicYear')->name('admin.add.academic.year');


	// route to add save academic year
	Route::post('/academic-year/add', 'AdminController@postAddAcademicYear')->name('admin.add.academic.year.post');

	// route to close academic year
	Route::post('/academic-year/close', 'AdminController@postCloseAcademicYear')->name('admin.close.academic.year.post');


	// route to set semester
	Route::post('/semester/set', 'AdminController@postSetSemester')->name('admin.set.semester.post');

	// route to set next semester
	Route::get('/semester/set/active/{id}', 'AdminController@setSemester')->name('admin.set.semester');

	// route to view settings in rates and fees
	Route::get('/rates-fees/settings', 'AdminController@viewRateFeeSettings')->name('admin.rate.fee.settings');

	// route to add misc fee form
	Route::get('/rates-fees/add', 'AdminController@addMiscFee')->name('admin.add.misc.fee');


	// route to edit msic fee
	Route::get('/rates-fees/{id}/update', 'AdminController@updateMiscFee')->name('admin.update.misc.fee');

	// route to save updte on misc fee
	Route::post('/rates-fees/update', 'AdminController@postUpdateMiscFee')->name('admin.update.misc.fee.post');

	// route to delete misc fee
	Route::get('/rates-fees/delete/{id}', 'AdminController@deleteMiscFee')->name('admin.delete.misc.fee');

	// route to add misc fee
	Route::post('/rates-fees/add', 'AdminController@postAddMiscFee')->name('admin.add.misc.fee.post');

	// route to view rooms
	Route::get('/rooms', 'AdminController@viewRooms')->name('admin.view.rooms');

	// route to add room
	Route::get('/room/add', 'AdminController@addRoom')->name('admin.add.room');

	// route to save added room
	Route::post('/room/add', 'AdminController@postAddRoom')->name('admin.add.room.post');

	// route to update room
	Route::get('/room/{id}/update', 'AdminController@updateRoom')->name('admin.update.room');

	// route to save update on room 
	Route::post('/room/update', 'AdminController@postUpdateRoom')->name('admin.update.room.post');

	// route to view add update schedules
	Route::get('/schedules', 'AdminController@viewSchedules')->name('admin.view.schedules');

	// route to add schedules
	Route::get('/schedule/add', 'AdminController@addSchedule')->name('admin.add.schedule');

	// rotue to save added schedule
	Route::post('/schedule/add', 'AdminController@postAddSchedule')->name('admin.add.schedule.post');

	// route to remove schedule
	Route::get('/schedule/{id}/remove', 'AdminController@removeSchedule')->name('admin.remove.schedule');

	// route to veiw settings in enrollment
	Route::get('/enrollment', 'AdminController@enrollment')->name('admin.enrollment');

	// route to save active enroll option
	Route::post('/enrollment', 'AdminController@postSaveEnrollment')->name('admin.save.enrollment.post');

	// route to save enrollment settin
	Route::post('/enrollment/setting', 'AdminController@postenrollmentSetting')->name('admin.enrollment.setting.post');

	// route to view assessments
	Route::get('/assessments', 'AdminController@viewAssessments')->name('admin.view.assessments');

	// route to view assessment details
	Route::get('/assessment/{id}/details', 'AdminController@viewAssessemntDetails')->name('admin.view.assessment.details');

	// route to view payments in paypal
	Route::get('/paypal/payments', 'AdminController@viewPaypalPayments')->name('admin.view.payments');
});