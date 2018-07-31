<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('documents', 'DocumentController@index');
    Route::get('documents/{document}', 'DocumentController@show');
    Route::post('documents', 'DocumentController@store');
    Route::post('documents/export/{document}', 'DocumentController@export');
    Route::put('documents/{document}', 'DocumentController@update');
    Route::delete('documents/{document}', 'DocumentController@delete');
    Route::post('logout', 'Auth\LoginController@logout');
});
