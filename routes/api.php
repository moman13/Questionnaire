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

Route::post('password/reset', 'Api\ForgotPasswordController@getResetToken');
Route::post('/login','Api\AuthApiController@login');

Route::get('/testmmm','Api\AuthApiController@testmmm');
Route::post('/sms_code','Api\AuthApiController@smsCode');
Route::post('/resend_sms_code','Api\AuthApiController@resend_sms_code');

Route::group(['middleware' => ['jwt.verify']], function () {
    /** Question */
    Route::get('/getAllQuestion','Api\QuestionApiController@getAllQuestion');

    Route::post('answersSave','Api\QuestionApiController@answersSave');
    Route::post('answersUpdate','Api\QuestionApiController@answersUpdate');
    Route::post('answersDelete','Api\QuestionApiController@answersDelete');
    /** End Question */

    Route::post('/client','Api\CustomerApiController@store');
    Route::post('/client/delete','Api\CustomerApiController@delete');

    /* User Api */
    Route::post('/users/update','Api\AuthApiController@update');
    Route::post('password/change', 'Api\AuthApiController@passwordChange');
    Route::post('/logout','Api\AuthApiController@logout');
    /* End User */

    /** home */
    Route::get('/home','Api\GeneralApiController@home');

    /**  */
});