<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'shops'], function () {
    Route::get('/',                     'StoresController@index');
    Route::post('/',                    'StoresController@store');
    Route::get('/{id}',                 'StoresController@show');
    Route::put('/{id}',                 'StoresController@update');
    Route::delete('/{id}',              'StoresController@destroy');
    Route::get('/with/{relationships}', 'StoresController@with');
});
