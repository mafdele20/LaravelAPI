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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('type_clients', 'TypeClientAPIController');

Route::resource('employeurs', 'EmployeurAPIController');

Route::resource('clients', 'ClientAPIController');

Route::resource('type_comptes', 'TypeCompteAPIController');

Route::resource('comptes', 'CompteAPIController');

Route::resource('type_operations', 'TypeOperationAPIController');

Route::resource('type_opeartions', 'TypeOpeartionAPIController');

Route::resource('operations', 'OperationAPIController');