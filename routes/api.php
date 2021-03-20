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

Route::prefix('juegos')->group(function () {
  Route::get('/', 'ApiController@index')->name('getAllJuegos');
  Route::post('/', 'ApiController@store')->name('addJuego');
  Route::get('{slug}', 'ApiController@show')->name('getJuego');
  Route::put('{slug}', 'ApiController@update')->name('editJuego');
  Route::delete('/delete/{slug}', 'ApiController@delete')->name('deleteJuego');
  Route::post('/filter/search/', 'ApiController@filter')->name('filterJuego');
});