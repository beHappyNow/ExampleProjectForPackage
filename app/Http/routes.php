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

Route::get('/', function () {
    return view('welcome');
});


Route::get('test', [ 'as' => 'test', 'uses' => 'NewPackageController@index']);
Route::get('test1', [ 'as' => 'test1', 'uses' => 'NewPackageController@testGeoCoder']);
Route::post('geocode', [ 'as' => 'geocode', 'uses' => 'NewPackageController@geocode']);
Route::post('geocode_reverse', [ 'as' => 'geocode_reverse', 'uses' => 'NewPackageController@geocode_reverse']);