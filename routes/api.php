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

Route::post('login', 'App\Http\Controllers\Api\Auth\LoginController@login');

Route::get('country','App\Http\Controllers\Api\Country\CountryController@country');

Route::middleware('jwt.verify')->group(function(){
    Route::get('country/{id}','App\Http\Controllers\Api\Country\CountryController@countryById');
    Route::post('country','App\Http\Controllers\Country\Api\CountryController@countrySave');
    Route::put('country/{country}','App\Http\Controllers\Api\Country\CountryController@countryEdit');
    Route::delete('country/{country}','App\Http\Controllers\Api\Country\CountryController@countryDelete');
    Route::post('refresh', 'App\Http\Controllers\Api\Auth\LoginController@refresh');
});


