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


Route::post('/servicelist', "ServiceListController@store");
Route::patch('/servicelist/{repairService}', "ServiceListController@update");
Route::delete('/servicelist/{repairService}', "ServiceListController@destroy");
Route::post('/contractor', "ContractorController@store");
Route::patch('/contractor/{contractor}', "ContractorController@update");
Route::delete('/contractor/{contractor}', "ContractorController@destroy");
Route::post('/customer', "CustomerController@store");
Route::patch('/customer/{customer}', "CustomerController@update");
Route::delete('/customer/{customer}', "CustomerController@destroy");
