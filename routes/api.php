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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('juegos', 'ApiController@getAll')->name('getAllJuegos');
Route::put('juegos', 'ApiController@add')->name('addJuego');
Route::get('juegos/{id}', 'ApiController@get')->name('getJuego');
Route::post('juegos/{id}', 'ApiController@edit')->name('editJuego');
Route::get('juegos/delete/{id}', 'ApiController@delete')->name('deleteJuego');
Route::post('juegos/filter/search/', 'ApiController@filter')->name('filterJuego');