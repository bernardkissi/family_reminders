<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
// return $request->user();
//});

Route::get('/members', 'MembersController@index')->name('get.members');
Route::post('/members', 'MembersController@add')->name('add.members');
Route::patch('/members/{member}', 'MembersController@update')->name('update.members');
Route::delete('/members/{member}', 'MembersController@delete')->name('delete.members');

Route::get('/reminders/nextday', 'MembersController@nextToBeReminded')->name('reminded.nextday');
Route::get('/reminders/today', 'MembersController@remindedToday')->name('reminded.today');

Route::post('/announcements', 'MessageController@send')->name('send.announcements');

Route::post('/messages', 'MessageController@add')->name('add.message');
Route::patch('/default/{message}', 'MessageController@setDefault')->name('add.message');
Route::patch('/messages/{message}', 'MessageController@update')->name('add.message');
Route::delete('/messages/{message}', 'MessageController@delete')->name('delete.message');


Route::post('/contribution', 'ContributionController@create')->name('create.contribution');
Route::get('/contribution/{contribute:slug}', 'ContributionController@index')->name('index.contribution');
Route::patch('/contribution/{contribute:slug/edit', 'ContributionController@update')->name('update.contribution');
Route::delete('/contribution/{contribute:slug}/delete', 'ContributionController@delete')->name('delete.contribution');

Route::post('/contribute', 'PaymentController@contribute')->name('contribute.payment');
Route::patch('/process_payment', 'PaymentController@processPayment')->name('process.payment');
Route::get('/payments', 'PaymentController@index')->name('index.payments');