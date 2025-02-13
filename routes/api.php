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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::post('add-hobby','UserController@create');
Route::post('update-hobby','UserController@update');
Route::get('delete-hobby/{id}','UserController@delete');
Route::get('all-hobby/{id}','UserController@allhobby');
Route::group(['middleware' => ['jwt.auth']], function() {
Route::get('logout', 'AuthController@logout');
});