<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DesarrolladoraController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\JuegoController;

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
  Route::get('/', [JuegoController::class, 'index'])->name('getAllJuegos');
  Route::post('/', [JuegoController::class, 'store'])->name('addJuego')->middleware('auth:sanctum');
  Route::get('{slug}', [JuegoController::class, 'show'])->name('getJuego');
  Route::post('/edit', [JuegoController::class, 'update'])->name('editJuego')->middleware('auth:sanctum');
  Route::put('/edit', [JuegoController::class, 'updatewithoutimage'])->name('editJuegoWithoutImage')->middleware('auth:sanctum');
  Route::delete('/delete/{slug}', [JuegoController::class, 'delete'])->name('deleteJuego')->middleware('auth:sanctum');
  Route::post('/filter/search/', [JuegoController::class, 'filter'])->name('filterJuego');
  Route::get('/desarrolladoras/{slug}', [DesarrolladoraController::class, 'show'])->name('getJuegoDesarrolladora');
  Route::get('/generos/show/all', [GeneroController::class, 'index'])->name('getAllGeneros');
  Route::get('/generos/{slug}', [GeneroController::class, 'show'])->name('getJuegosGenero');
});

Route::prefix('auth')->group(function () {
  Route::post('register', [AuthController::class, 'register'])->name('register');
  Route::post('login', [AuthController::class, 'login'])->name('login');
  Route::get('userinfo', [AuthController::class, 'userinfo'])->name('userinfo')->middleware('auth:sanctum');
  Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});