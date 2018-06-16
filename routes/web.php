<?php

Route::get('/', 'LoginController@welcome')->name('welcome');


Route::get('/student/login', 'LoginController@login')->name('student.login');


Route::get('/student/registration', 'RegistrationController@registration')->name('student.registration');


Route::get('/admin/login', 'AdminLoginController@login')->name('admin.login');


/*
 * Student Route Group
 * controller protected middleware
 */
Route::group(['prefix' => 'student'], function () {
	// student dashbaord

});


/*
 * Admin Route Group
 * controller protected middleware
 */
Route::group(['prefix' => 'admin'], function () {
	// admin dashboard
});