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

Route::get('/', function () {
    return view('welcome');
});

Route::post('registration', 'API\RegistrationsController@registration');

// routes for login users
Route::group(['middleware' => ['api_auth']], function () {

    Route::get('user/details', 'API\UsersController@details');

    Route::post('note/create', 'API\NotesController@create');

    Route::post('note/update', 'API\NotesController@update');

    Route::get('note', 'API\NotesController@index');

});