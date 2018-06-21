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

	// route to cashier profile
	Route::get('/profile', 'CashierController@profile')->name('cashier.profile');

	// route to view updte profile
	Route::get('/profile/update', 'CashierController@updateProfile')->name('cashier.profile.update');

	// route to update profile of cashier
	Route::post('/profile/update', 'CashierController@postUpdateProfile')->name('cashier.profile.update.post');

	// route to show password update
	Route::get('/password/change', 'CashierController@changePassword')->name('cashier.password.change');

	// route to upate password
	Route::post('/password/change', 'CashierController@postChangePassword')->name('cashier.password.change.post');
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

	// route to view programs available
	Route::get('/programs', 'AdminController@viewPrograms')->name('admin.view.programs');
});