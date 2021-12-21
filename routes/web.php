<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ReservasController;
use \App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//perfil usuario
Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil.index');
Route::post('/perfil/update', [App\Http\Controllers\PerfilController::class, 'update'])->name('perfil.update');
Route::get('/perfil/destroy/{id}', [App\Http\Controllers\PerfilController::class, 'destroy'])->name('perfil.destroy');
//reservas
Route::resource('reservas', ReservasController::class);
Route::get('/comprobarReservas/{fecha}', [ReservasController::class, 'comprobarButacas']);
Route::post('/reservas/actualizar', [ReservasController::class, 'updateReserva'])->name('reservas.actualizar');
