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

Route::apiResource('Categories','catController');
Route::apiResource('Service','serviceController');


Route::get('gettheKids/{id}','catController@gettheKids');

Route::get('gettheparent/{id}','catController@gettheparent');



Route::post('Register','UserController@Register');
Route::post('login',[ 'as' => 'login', 'uses' => 'UserController@login']);


//Route::get('gettheparentbyserv/{id}','catController@gettheparentbyserv');


Route::get('Search/{keyword}','serviceController@Search');

Route::get('GetSubCatByCat/{id}','catController@GetSubCatByCat');
Route::get('getServiceByCat/{id}','serviceController@getServiceByCat');

