<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MT_Login_Controller as Login_Controller;
use App\Http\Controllers\MT_Register_Controller as Register_Controller;
use App\Http\Controllers\MT_Dashboard_Controller as Dashboard_Controller;
use App\Http\Controllers\MT_Booking_Controller as Booking_Controller;
use App\Http\Controllers\MT_Booking_Controller as Guest_Controller;
use App\Http\Controllers\MT_Property_Controller as Owner_Controller;
use App\Http\Middleware\MT_Login_Middleware;
use App\Http\Middleware\MT_Logout_Middleware;

/*
|--------------------------------------------------------------------------
| Routes for MINI TRAUM website
|--------------------------------------------------------------------------
| website : http://mini_traum.test/
|
*/
/*
 * Route to display guest/owner dashboard based on their login
 */

Route::get('/',[Dashboard_Controller::class,'landingPage']);
#Takes to dashboard page after passing through 'MT_Login_Middleware' middleware
Route::get('/dashboard',[Dashboard_Controller::class,'show_dashboard'])->middleware([MT_Login_Middleware::class])->name('dashboard');


#Directes to login page after passing through 'MT_Logout_Middleware' middleware
Route::get('/login',[Login_Controller::class,'login_page'])->middleware([MT_Logout_Middleware::class]);

#Create's user session
Route::post('/login',[Login_Controller::class,'make_session']);

#Destroys session
Route::get('/logout',[Login_Controller::class,'logout'])->name('logout');

#Takes to register page after passing through 'MT_Logout_Middleware' middleware
Route::get('/register',[Register_Controller::class,'register'])->middleware([MT_Logout_Middleware::class]);

#Registers user details
Route::post('/register',[Register_Controller::class,'register_user']);

#Takes to guest's dashboard page
Route::get('/guest',[Guest_Controller::class,'guest_dashboard']);

#Takes to guest to past actions page
Route::get('/guest/booking-history',[Guest_Controller::class,'pastactions']);

/**
 * Property Resource
 */
Route::resource('properties',Owner_Controller::class);

Route::put('/dashboard/properties/{property}/publish', [Owner_Controller::class, 'publish'])->name('properties.publish');

Route::put('/dashboard/properties/{booking}', [Owner_Controller::class, 'change_status'])->name('properties.change_status');

Route::get('/dashboard/booking-history', [Owner_Controller::class, 'bookingHistory'])->name('booking-history');

/**
 * Booking Routes
 */

Route::post('/searchProperties', [Booking_Controller::class, 'showPropertiesByLocation'])->name('searchedProperties');
Route::post('/propertyDetails', [Booking_Controller::class, 'propertyDetails'])->name('propertyDetails');
Route::post('/{property}/store', [Booking_Controller::class, 'store']);
Route::get('/pastBookings', [Booking_Controller::class, 'showPastBookings']);
Route::get('/upComingBookings', [Booking_Controller::class, 'upComingBookings']);

Route::get('/upComingBookings/{bookingId}/edit', [Booking_Controller::class, 'edit']);
Route::post('/upComingBookings/{bookingId}/update', [Booking_Controller::class, 'update']);
Route::get('/upComingBookings/{bookingId}/cancel', [Booking_Controller::class, 'cancel']);
