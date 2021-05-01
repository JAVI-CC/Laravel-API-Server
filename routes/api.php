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
  Route::post('/', 'ApiController@store')->name('addJuego')->middleware('auth:sanctum');
  Route::get('{slug}', 'ApiController@show')->name('getJuego');
  Route::post('/edit', 'ApiController@update')->name('editJuego')->middleware('auth:sanctum');
  Route::put('/edit', 'ApiController@updatewithoutimage')->name('editJuegoWithoutImage')->middleware('auth:sanctum');
  Route::delete('/delete/{slug}', 'ApiController@delete')->name('deleteJuego')->middleware('auth:sanctum');
  Route::post('/filter/search/', 'ApiController@filter')->name('filterJuego');
  Route::get('/desarrolladoras/{slug}', 'DesarrolladoraController@show')->name('getJuegoDesarrolladora');

});

Route::prefix('auth')->group(function () {
  Route::post('register', 'AuthController@register')->name('register');
  Route::post('login', 'AuthController@login')->name('login');
  Route::get('userinfo', 'AuthController@userinfo')->name('userinfo')->middleware('auth:sanctum');
  Route::post('logout', 'AuthController@logout')->name('logout')->middleware('auth:sanctum');
});
