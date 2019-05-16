<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 

Auth::routes();


Route::middleware('auth')->group(function(){

	Route::middleware('role:sup_admin')->group(function(){
			/**  
			** Authenticated Admin
			*/ 

		Route::prefix('theadmin')->group(function(){
			/** Create hotel */
			Route::get('/user/{user}/create_hotel', 'Hotel\HotelController@create')
					->name('admin.user.create_hotel');
			Route::post('/user/{user}/create_hotel', 'Hotel\HotelController@store');

			/* END */

			Route::get('/', 'Admin\AdminController@show');
			Route::get('users', 'Admin\AdminController@users')->name('admin.users');

			Route::get('/user/{user}', 'Admin\UsersController@show')->name('admin.user'); 

			Route::get('/user/{user}/bookings', 'Admin\UsersController@bookings')
					->name('admin.user.bookings');

			Route::get('amenities','Hotel\AmenityController@index')->name('admin.amenities');
			Route::post('amenities','Hotel\AmenityController@store');

			Route::get('discounts','Discount\DiscountController@adminIndex');
			// Route::get('discounts','Discount\DiscountController@index');
		});


	});

	Route::middleware('role:owner')->group(function(){ 

		Route::prefix('profile')->group(function(){

			Route::get('owner','Owner\OwnerController@index');
			Route::get('owner/booking/{booking}','Owner\OwnerController@booking');

			Route::get('/booking/{refference}','Booking\BookingController@showForOwner')->name('owner.booked');
 
		});
		

		Route::get('hotel/{hotel_slug}/create', 'Hotel\RoomController@create')->name('create_room');
		Route::post('hotel/{hotel_slug}/create', 'Hotel\RoomController@store');

		Route::get('room/{slug}/edit', 'Hotel\RoomController@edit')->name('room.edit');
		Route::post('room/{slug}/edit', 'Hotel\RoomController@update');

		Route::post('room/{slug}/delete', 'Hotel\RoomController@destroy')->name('room.delete');


		Route::get('/hotel/{hotel}/edit', 'Hotel\HotelController@edit')
					->name('admin.user.edit_hotel');
		Route::post('/hotel/{hotel}/edit', 'Hotel\HotelController@update');


		
	});


		Route::post('/room/{slug}','Hotel\ReviewController@store');

		Route::get('/profile','Profile\ProfileController@index')->name('profile');

		 Route::get('/pay','Booking\BookingController@pay')->name('pay');
		 Route::post('/pay','Booking\BookingController@completePay')->name('pay');

		 Route::get('/booking/{refference}','Booking\BookingController@show')->name('booked');

		 // Route::get('/room/{slug}/book','Booking\BookingController@bookRe');

		
});





Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index');

Route::get('/hotels', 'Hotel\HotelController@index')->name('hotels');

Route::get('/hotel/{hotel}', 'Hotel\HotelController@show')->name('hotel');






/***
	Router : Room
*/
Route::get('/rooms', 'Hotel\RoomController@index')->name('room_home');

Route::get('/room/{slug}','Hotel\RoomController@show')->name('room');

Route::get('/search','SearchController@index')->name('search');

 Route::post('/room/{slug}/book','Booking\BookingController@book')->name('book');


/******
'hotels/anything_else'
is shoud add to hotel.php model function contains()
if someone creates hotels with name "create" makes trouble
*/


Route::prefix('vjx')->group(function(){
	require 'ajax.php';
});

 
 
 





