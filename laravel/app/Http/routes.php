<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/dvds/search', 'DvdController@search');

Route::get('/dvds', 'DvdController@results');

Route::get('/dvds/create', 'DvdController@dvdForm');
Route::post('/dvds/create/dvd', array('as' => 'storeDvd', 'uses' => 'DvdController@storeDvd'));

Route::get('/dvds/{id}', 'DvdController@reviews');
Route::post('/dvds', array('as' => 'storeReview', 'uses' => 'DvdController@storeReview'));

Route::get('/genres/{genre_name}/dvds', 'DvdController@getDvdFromGenre');