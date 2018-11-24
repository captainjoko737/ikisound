<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/landingPage');
});

Route::group(['middleware' => 'auth'], function(){

# A D M I N
	Route::get('/dashboard', 'AdminCtrl@index');

# P A C K A G E

	Route::get('/admin/package', 'PackageCtrl@package');
	Route::get('/admin/package/new', 'PackageCtrl@newPackage');
	Route::post('postNewPackage',['as'=>'postNewPackage','uses'=>'PackageCtrl@createNewPackage']);

	Route::get('/admin/package/edit/{id_package}', 'PackageCtrl@editPackage');
	Route::put('putPackage',['as'=>'putPackage','uses'=>'PackageCtrl@savePackage']);

	Route::delete('/admin/package', 'PackageCtrl@deletePackage');

# P O R T O F O L I O

	Route::get('/admin/portofolio', 'PortofolioCtrl@adminPortofolio');
	Route::get('/admin/portofolio/new', 'PortofolioCtrl@newPortofolio');
	Route::post('postNewPortofolio',['as'=>'postNewPortofolio','uses'=>'PortofolioCtrl@createNewPortofolio']);

	Route::get('/admin/portofolio/edit/{id_portofolio}', 'PortofolioCtrl@editPortofolio');
	Route::put('putPortofolio',['as'=>'putPortofolio','uses'=>'PortofolioCtrl@savePortofolio']);

	Route::delete('/admin/portofolio', 'PortofolioCtrl@deletePortofolio');

# P E N G E L U A R A N

	Route::get('/admin/pengeluaran', 'PengeluaranCtrl@index');
	Route::get('/admin/pengeluaran/new', 'PengeluaranCtrl@add');
	Route::post('postPengeluaran',['as'=>'postPengeluaran','uses'=>'PengeluaranCtrl@create']);

	Route::get('/admin/pengeluaran/edit/{id_pengeluaran}', 'PengeluaranCtrl@editPengeluaran');
	Route::put('putPengeluaran',['as'=>'putPengeluaran','uses'=>'PengeluaranCtrl@savePengeluaran']);

	Route::delete('/admin/pengeluaran', 'PengeluaranCtrl@deletePengeluaran');
	

# A L L  U S E R

	Route::get('/admin/allUser', 'AdminCtrl@AllUser');
	Route::get('/admin/allUser/new', 'UserCtrl@newUserCrew');
	Route::post('postNewCrew',['as'=>'postNewCrew','uses'=>'UserCtrl@createNewCrew']);
	Route::delete('/admin/user', 'UserCtrl@deleteUser');

# A L L  A D M I N

	Route::get('/admin/allAdmin', 'AdminCtrl@AllAdmin');
	Route::get('/admin/allAdmin/new', 'UserCtrl@newUserAdmin');
	Route::post('postNewAdmin',['as'=>'postNewAdmin','uses'=>'UserCtrl@createNewAdmin']);
	Route::delete('/admin/admin', 'UserCtrl@deleteAdmin');

# B O O K I N G
	Route::get('/booking', 'BookingCtrl@index');
	Route::get('/statusBooking', 'BookingCtrl@statusBookingCustomer');
	Route::post('bookingSelected',['as'=>'bookingSelected','uses'=>'BookingCtrl@bookingSelected']);
	Route::post('/booking/confirmation', 'BookingCtrl@bookingConfirmation');
	Route::get('/booking/selected/{id_package}/{event_date}/{event_name}/{event_location}', 'BookingCtrl@bookingSelected');
	Route::get('/booking/finished', 'BookingCtrl@bookingFinished');

	Route::get('/admin/booking', 'BookingCtrl@adminBooking');
	Route::get('/admin/bookingDetail/{id_booking}', 'BookingCtrl@bookingDetail');
	Route::delete('/admin/booking', 'BookingCtrl@deleteBooking');

	Route::get('/admin/booking/approve/{id_booking}', 'BookingCtrl@approveBooking');
	Route::post('postNewApproved',['as'=>'postNewApproved','uses'=>'BookingCtrl@approveBookingSave']);

# P R O F I L E

	Route::get('/myProfile', 'UserCtrl@myProfile');
	Route::get('/updateProfile/{id_user}', 'UserCtrl@updateProfile');
	Route::post('updateProfile',['as'=>'updateProfile','uses'=>'UserCtrl@saveUpdateProfile']);


	Route::get('/admin/crewSalary', 'AdminCtrl@CrewSalary');

# C R E W  S A L A R Y
	Route::get('/crewSalary', 'CrewSalaryCtrl@index');
	Route::get('/admin/crewSalary/paid', 'CrewSalaryCtrl@paidCrew');
	Route::post('postCrewPayment',['as'=>'postCrewPayment','uses'=>'CrewSalaryCtrl@createNewCrewPayment']);
	Route::delete('/admin/crewSalary', 'CrewSalaryCtrl@deleteCrewSalary');

	Route::get('auth/logout', 'Auth\AuthController@getLogout');

});

Route::get('/dataSchedule', 'ScheduleCtrl@dataSchedule');

# A U T H E N T I C A T E

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('/login', 'UserCtrl@login');
Route::get('/register', 'UserCtrl@register');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('postLogin');
Route::post('register',['as'=>'register','uses'=>'UserCtrl@createAccount']);

# P A G E  A L L O W A B L E

Route::get('/landingPage', 'LandingPageCtrl@index');
Route::get('/portofolio', 'PortofolioCtrl@index');
Route::get('/schedule', 'ScheduleCtrl@index');
Route::get('/package', 'PackageCtrl@index');
Route::get('/forgetPassword', 'UserCtrl@forgetPassword');
Route::post('postForgetPassword',['as'=>'postForgetPassword','uses'=>'UserCtrl@confirmForgetPassword']);


