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

// redirect to faculty login form
Route::get('/faculty', function () {
	return redirect()->route('faculty.login');
});


Route::get('/cashier/login', 'CashierLoginController@login')->name('cashier.login');

// redirect to cashier login form
Route::get('/cashier', function () {
	return redirect()->route('cashier.login');
});


Route::get('/registrar/login', 'RegistrarLoginController@login')->name('registrar.login');

// redirect to registrar login form
Route::get('/registrar', function () {
	return redirect()->route('registrar.login');
});


Route::get('/admin/login', 'AdminLoginController@login')->name('admin.login');

// redirect to admin login
Route::get('/admin', function () {
	return redirect()->route('admin.login');
});


Route::get('/student/registration', 'RegistrationController@registration')->name('student.registration');


Route::post('/student/registration', 'RegistrationController@postRegistration')->name('student.registration.post');


Route::get('/faculty/registration', 'FacultyRegistrationController@registration')->name('faculty.registration');


Route::get('/logout', 'GeneralController@logout')->name('logout');


/*
 * Student Route Group
 * controller protected middleware
 */
Route::group(['prefix' => 'student'], function () {
	// student dashboard
	Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');

});


/*
 * Faculty Route Group
 */
Route::group(['prefix' => 'faculty'], function () {
	// faculty dashboard
	Route::get('/dashboard', 'FacultyController@dashboard')->name('faculty.dashboard');
});


/*
 * Cashier Route Group
 */
Route::group(['prefix' => 'cashier'], function () {
	// cashier dashboard
	Route::get('/dashboard', 'CashierController@dashboard')->name('cashier.dashboard');
});


/*
 * Registrar Route Group
 */
Route::group(['prefix' => 'registrar'], function () {
	// registrar dashboard
	Route::get('/dashboard', 'RegistrarController@dashboard')->name('registrar.dashboard');
});


/*
 * Admin Route Group
 * controller protected middleware
 */
Route::group(['prefix' => 'admin'], function () {
	// admin dashboard
	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
});