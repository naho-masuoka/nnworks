<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/{user_url}', 'ContactController@index')->name('user_top');

Route::post('/reserve', 'TimetableController@reserve')->name('reserve');
Route::post('/reserve_thanks', 'ContactController@reserve_thanks')->name('reserve_thanks');


Route::get('/cancel', 'TimetableController@cancel')->name('cancel');
Route::post('/cancel_complete', 'TimetableController@cancel_complete')->name('cancel_complete');
Route::post('/cancel_rejection', 'TimetableController@cancel')->name('cancel_rejection');
Route::get('/error', 'TimetableController@error_message')->name('error_message');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', 'UsersController@index')->name('users');
    Route::post('/user_update', 'UsersController@update')->name('user_update');

    Route::get('/title', 'TitlesController@index')->name('title');
    Route::post('/title_post', 'TitlesController@store_edit')->name('title_post');

    Route::get('/time_table', 'TimetableController@index')->name('time_teble');
    Route::post('/time_table_store', 'TimetableController@store')->name('time_teble_store'); 

    Route::post('/email_create', 'TimetableController@email_create')->name('email_create');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/reply', 'TimetableController@reply')->name('reply');
    Route::post('/reply_send', 'TimetableController@reply_send')->name('reply_send');

    Route::get('/messages', 'MessageController@index')->name('message');
    Route::post('/message_create', 'MessageController@create_edit')->name('message_create_edit');

    Route::get('/cancel_sample', 'TimetableController@cancel_sample')->name('cancel_sample');
    Route::get('/cancel_rejection_sample', 'TimetableController@rejection_sample')->name('rejection_sample');
});