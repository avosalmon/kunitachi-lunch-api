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
    Route::get('/',                     'ShopsController@index');
    Route::post('/',                    'ShopsController@store');
    Route::get('/{id}',                 'ShopsController@show');
    Route::put('/{id}',                 'ShopsController@update');
    Route::delete('/{id}',              'ShopsController@destroy');
    Route::get('/with/{relationships}', 'ShopsController@with');
});
