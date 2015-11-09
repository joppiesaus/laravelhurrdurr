<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/mail', "HomeController@showWelcome");
Route::post('/mail', "EmailController@sendEmail");

Route::get('/excel', 'ExcelController@showDefaultView');
Route::post('/excel', 'ExcelController@makeSheet');

Route::get('/dropbox', "DropboxController@authorize");

Route::get('/dropboxauth', 'DropboxController@authorizeReturn');
Route::get('/dropbox-dashboard', "DropboxController@show");
Route::post('/dropbox-dashboard-download', "DropboxController@downloadFile");
Route::post('/dropbox-dashboard-upload', "DropboxController@uploadFile");
