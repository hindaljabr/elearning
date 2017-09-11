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

Route::get('/', 'HomeController@getIndex')->name('home');

Route::get('/contactus', 'ContactController@getIndex')->name('contactus');

// display the page logged in users see where we will list the available rooms
Route::get('/rooms', 'ReservationController@getRooms')->name('rooms.list');

// display the reservation form for a room
Route::get('/{room_id}/reservation-form', 'ReservationController@getReservationForm')->name('reservation.form');

//display room details
Route::get('/{room_id}/roomdetails','RoomController@getRoomDetails')->name('roomdetails');

// save the submited reservation form
Route::post('/{room_id}/reservation-form', 'ReservationController@postReservationForm');

// show the admin page for managing the rooms
Route::get('/admin/manage', 'AdminController@getManageReservation')->name('admin.manage');

// approve a reservation
Route::get('/admin/{reservation_id}/approve-reservation', 'AdminController@getApproveReservation')->name('reservation.approve');

// reject a reservation
Route::get('/admin/{reservation_id}/reject-reservation', 'AdminController@getRejectReservation')->name('reservation.reject');

// show the user page for managing the reservations
Route::get('/user/manage', 'UserController@getManageReservation')->name('user.manage');
// display the add room form
Route::get('/addRoom_form', 'RoomController@getaddRoomForm')->name('addRoom_form.form');
// save the submited add room form
Route::post('/addRoom_form', 'RoomController@postaddRoomForm');

Route::get('manageRoom','RoomController@getManageRoom')->name('admin.manageRoom');
