<?php

use App\Http\Controllers\API\Members\MemberController;
use App\Http\Controllers\API\Message\MessageController;
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

Route::get('/members', [ MemberController::class, 'members' ]);
Route::post('/members', [ MemberController::class, 'create' ]);
Route::patch('/members/{member}', [ MemberController::class, 'update']);
Route::delete('/members/{member}', [ MemberController::class, 'delete']);
Route::delete('/members', [ MemberController::class, 'deleteSelected']);

Route::patch('/members/switchDay', [ MemberController::class, 'switchDay']);

Route::get('/reminders/tomorrow', [ MemberController::class, 'tomorrow']);
Route::get('/reminders/today', [ MemberController::class, 'today']);

Route::get('/messages', [ MessageController::class, 'messages']);
Route::post('/messages', [ MessageController::class, 'create']);
Route::patch('/messages/{message}', [ MessageController::class, 'update']);
Route::patch('/messages/default/{message}', [MessageController::class, 'default']);
Route::delete('/messages/{message}',  [MessageController::class, 'delete']);
Route::delete('/messages',  [MessageController::class, 'deleteSelected']);

// Route::post('/members', 'MembersController@add')->name('add.members');
// Route::patch('/members/{member}', 'MembersController@update')->name('update.member');
// Route::patch('/members', 'MembersController@updateMultiple')->name('update.members');
// Route::delete('/members', 'MembersController@deleteMultiple')->name('delete.members');
// Route::delete('/members/{member}', 'MembersController@delete')->name('delete.member');

// Route::get('/reminders/nextday', 'MembersController@nextToBeReminded')->name('reminded.nextday');
// Route::get('/reminders/today', 'MembersController@remindedToday')->name('reminded.today');

// Route::post('/announcement', 'MessageController@sendMessage')->name('send.announcements');

// Route::post('/messages', 'MessageController@add')->name('add.message');
// Route::patch('/default/{message}', 'MessageController@setDefault')->name('add.message');
// Route::patch('/messages/{message}', 'MessageController@update')->name('add.message');
// Route::delete('/messages/{message}', 'MessageController@delete')->name('delete.message');
// Route::get('/messages', 'MessageController@index')->name('get.messages');


// Route::post('/contribution', 'ContributionController@create')->name('create.contribution');
// Route::get('/contribution/{contribute:slug}', 'ContributionController@index')->name('index.contribution');
// Route::patch('/contribution/{contribute:slug/edit', 'ContributionController@update')->name('update.contribution');
// Route::delete('/contribution/{contribute:slug}/delete', 'ContributionController@delete')->name('delete.contribution');

// Route::post('/contribute', 'PaymentController@contribute')->name('contribute.payment');
// Route::patch('/process_payment', 'PaymentController@processPayment')->name('process.payment');
// Route::get('/payments', 'PaymentController@index')->name('index.payments');
