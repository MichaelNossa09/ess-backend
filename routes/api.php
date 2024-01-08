<?php

use App\Http\Controllers\ConectividadController;
use App\Http\Controllers\EstatusController;
use App\Http\Controllers\EstatusServidoresController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NodosController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PoolEventoController;
use App\Http\Controllers\PoolsController;
use App\Http\Controllers\ServidoresController;
use App\Models\EstatusServidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/users', [LoginController::class, 'getUsers'])->name('users');
    Route::get('/user/{correo}', [LoginController::class, 'getUserByID'])->name('user');

    Route::get('/pool', [PoolsController::class, 'index'])->name('index');
    Route::get('/pool/{id}', [PoolsController::class, 'show'])->name('show');
    Route::post('/pool', [PoolsController::class, 'store'])->name('store');
    Route::put('/pool/{id}', [PoolsController::class, 'update'])->name('update');
    Route::delete('/pool/{id}', [PoolsController::class, 'destroy'])->name('destroy');

    Route::get('/conectividad', [ConectividadController::class, 'index'])->name('index');
    Route::get('/conectividad/{id}', [ConectividadController::class, 'show'])->name('show');
    Route::post('/conectividad', [ConectividadController::class, 'store'])->name('store');
    Route::put('/conectividad/{id}', [ConectividadController::class, 'update'])->name('update');
    Route::delete('/conectividad/{id}', [ConectividadController::class, 'destroy'])->name('destroy');

    Route::get('/evento', [EventosController::class, 'index'])->name('index');
    Route::get('/evento/{id}', [EventosController::class, 'show'])->name('show');
    Route::post('/evento', [EventosController::class, 'store'])->name('store');
    Route::put('/evento/{id}', [EventosController::class, 'update'])->name('update');
    Route::delete('/evento/{id}', [EventosController::class, 'destroy'])->name('destroy');

    Route::get('/nodo', [NodosController::class, 'index'])->name('index');
    Route::get('/nodo/{id}', [NodosController::class, 'show'])->name('show');
    Route::post('/nodo', [NodosController::class, 'store'])->name('store');
    Route::put('/nodo/{id}', [NodosController::class, 'update'])->name('update');
    Route::delete('/nodo/{id}', [NodosController::class, 'destroy'])->name('destroy');

    Route::get('/poolevento', [PoolEventoController::class, 'index'])->name('index');
    Route::get('/poolevento/{id}', [PoolEventoController::class, 'show'])->name('show');
    Route::post('/poolevento', [PoolEventoController::class, 'store'])->name('store');
    Route::put('/poolevento/{id}', [PoolEventoController::class, 'update'])->name('update');
    Route::delete('/poolevento/{id}', [PoolEventoController::class, 'destroy'])->name('destroy');
    Route::get('/pools/{poolId}/evento', [PoolEventoController::class, 'getEventoByPool'])->name('getEventoByPool');
    Route::get('/eventos/{eventoId}/pools', [PoolEventoController::class, 'getPoolsByEvento'])->name('getPoolsByEvento');

    Route::get('/servidor', [ServidoresController::class, 'index'])->name('index');
    Route::get('/servidor/{id}', [ServidoresController::class, 'show'])->name('show');
    Route::post('/servidor', [ServidoresController::class, 'store'])->name('store');
    Route::put('/servidor/{id}', [ServidoresController::class, 'update'])->name('update');
    Route::delete('/servidor/{id}', [ServidoresController::class, 'destroy'])->name('destroy');
    Route::get('/servidor/{servidorId}/nodo', [ServidoresController::class, 'getNodoByServidor'])->name('getNodoByServidor');
    Route::get('/nodo/{nodoId}/servidores', [ServidoresController::class, 'getServidoresByNodo'])->name('getServidoresByNodo');

    Route::get('/estatus', [EstatusController::class, 'index'])->name('index');
    Route::get('/estatus/{id}', [EstatusController::class, 'show'])->name('show');
    Route::post('/estatus', [EstatusController::class, 'store'])->name('store');
    Route::put('/estatus/{id}', [EstatusController::class, 'update'])->name('update');
    Route::delete('/estatus/{id}', [EstatusController::class, 'destroy'])->name('destroy');

    Route::get('/estatusDetail', [EstatusServidoresController::class, 'index'])->name('index');
    Route::get('/estatusDetail/{id}', [EstatusServidoresController::class, 'show'])->name('show');
    Route::get('/estatusDetail/{estatusId}/servidores', [EstatusServidoresController::class, 'getServersByEstatus'])->name('getServersByEstatus');
    Route::post('/estatusDetail', [EstatusServidoresController::class, 'store'])->name('store');
    Route::put('/estatusDetail/{id}', [EstatusServidoresController::class, 'update'])->name('update');
    Route::delete('/estatusDetail/{id}', [EstatusServidoresController::class, 'destroy'])->name('destroy');

    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('index');
    Route::post('/notificaciones', [NotificacionController::class, 'store'])->name('store');
});


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
