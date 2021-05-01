<?php

use App\Http\Controllers\API\Contribution\ContributionController;
use App\Http\Controllers\API\Members\MemberController;
use App\Http\Controllers\API\Message\MessageController;
use App\Http\Controllers\API\Payments\PaymentController;
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
Route::post('/messages/send', [ MessageController::class, 'send']);
Route::patch('/messages/{message}', [ MessageController::class, 'update']);
Route::patch('/messages/default/{message}', [MessageController::class, 'default']);
Route::delete('/messages/{message}', [MessageController::class, 'delete']);
Route::delete('/messages', [MessageController::class, 'deleteSelected']);


Route::get('/contributions', [ContributionController::class, 'contributions']);
Route::post('/contribution', [ContributionController::class, 'create']);
Route::get('/contribution/{contribute:slug}', [ContributionController::class, 'contribution']);
Route::delete('/contribution/{contribute:slug}/delete', [ContributionController::class, 'delete']);
Route::patch('/contribution/{contribute:slug}/edit', [ContributionController::class, 'update']);

Route::post('/contribute/{contribution}', [PaymentController::class, 'contribute']);

// Route::post('/contribution', 'ContributionController@create')->name('create.contribution');
// Route::get('/contribution/{contribute:slug}', 'ContributionController@index')->name('index.contribution');
// Route::patch('/contribution/{contribute:slug/edit', 'ContributionController@update')->name('update.contribution');
// Route::delete('/contribution/{contribute:slug}/delete', 'ContributionController@delete')->name('delete.contribution');

// Route::post('/contribute', 'PaymentController@contribute')->name('contribute.payment');
// Route::patch('/process_payment', 'PaymentController@processPayment')->name('process.payment');
// Route::get('/payments', 'PaymentController@index')->name('index.payments');
