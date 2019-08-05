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
    return view('main');
});

Route::get('db', 'DatabaseController@index');
Route::get('db/b2a', 'DatabaseController@b2a');
Route::get('db/bua', 'DatabaseController@bua');
Route::get('db/aa7', 'DatabaseController@aa7');


Route::get('game', 'GameController@index');
Route::get('game/load', 'GameController@load');
Route::get('game/settings', 'GameController@settings');
