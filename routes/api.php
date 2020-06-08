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

Route::group(['middleware' => ['cors']], function () {      
    Route::group(['prefix' => 'employees'], function() {
    
        Route::post('/', 'EmployeeController@store');
        Route::get('/', 'EmployeeController@index');
        Route::get('/{id}', 'EmployeeController@singleEmployee');
        Route::put('/{id}', 'EmployeeController@update');
        Route::delete('/{id}', 'EmployeeController@destroy');
     });

});
