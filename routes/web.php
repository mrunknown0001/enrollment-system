<?php

Route::get('/', 'LoginController@welcome')->name('welcome');


Route::get('/student/login', 'LoginController@login')->name('student.login');


Route::post('/student/login', 'LoginController@postLogin')->name('student.login.post');


// redirect to student login form
Route::get('/student', function () {
	return redirect()->route('student.login');
});


Route::get('/faculty/login', 'FacultyLoginController@login')->name('faculty.login');

// redirect to faculty login form
Route::get('/faculty', function () {
	return redirect()->route('faculty.login');
});


Route::get('/student/registration', 'RegistrationController@registration')->name('student.registration');


Route::post('/student/registration', 'RegistrationController@postRegistration')->name('student.registration.post');


Route::get('/faculty/registration', 'FacultyRegistrationController@registration')->name('faculty.registration');


Route::get('/admin/login', 'AdminLoginController@login')->name('admin.login');

// redirect to admin login
Route::get('/admin', function () {
	return redirect()->route('admin.login');
});


/*
 * Student Route Group
 * controller protected middleware
 */
Route::group(['prefix' => 'student'], function () {
	// student dashbaord

});


/*
 * Faculty Route Group
 */
Route::group(['prefix' => 'faculty'], function () {
	// faculty dashboard
});


/*
 * Cashier Route Group
 */
Route::group(['prefix' => 'cashier'], function () {
	// cashier dashboard
});


/*
 * Registrar Route Group
 */
Route::group(['prefix' => 'registrar'], function () {
	// registrar dashboard
});


/*
 * Admin Route Group
 * controller protected middleware
 */
Route::group(['prefix' => 'admin'], function () {
	// admin dashboard
});