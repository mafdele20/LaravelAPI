<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', "CompteClientController@index");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('compteClient', 'CompteClientController');




Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::resource('typeComptes', 'TypeCompteController');

Route::resource('comptes', 'CompteController');

Route::resource('typeOperations', 'TypeOperationController');