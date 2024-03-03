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

    Route::get('/pool', [PoolsController::class, 'index'])->name('indexPool');
    Route::get('/pool/{id}', [PoolsController::class, 'show'])->name('showPool');
    Route::post('/pool', [PoolsController::class, 'store'])->name('storePool');
    Route::put('/pool/{id}', [PoolsController::class, 'update'])->name('updatePool');
    Route::delete('/pool/{id}', [PoolsController::class, 'destroy'])->name('destroyPool');

    Route::get('/conectividad', [ConectividadController::class, 'index'])->name('indexConect');
    Route::get('/conectividad/{id}', [ConectividadController::class, 'show'])->name('showConect');
    Route::post('/conectividad', [ConectividadController::class, 'store'])->name('storeConect');
    Route::put('/conectividad/{id}', [ConectividadController::class, 'update'])->name('updateConect');
    Route::delete('/conectividad/{id}', [ConectividadController::class, 'destroy'])->name('destroyConect');

    Route::get('/evento', [EventosController::class, 'index'])->name('indexEvent');
    Route::get('/evento/{id}', [EventosController::class, 'show'])->name('showEvent');
    Route::post('/evento', [EventosController::class, 'store'])->name('storeEvent');
    Route::put('/evento/{id}', [EventosController::class, 'update'])->name('updateEvent');
    Route::delete('/evento/{id}', [EventosController::class, 'destroy'])->name('destroyEvent');

    Route::get('/nodo', [NodosController::class, 'index'])->name('indexNodo');
    Route::get('/nodo/{id}', [NodosController::class, 'show'])->name('showNodo');
    Route::post('/nodo', [NodosController::class, 'store'])->name('storeNodo');
    Route::put('/nodo/{id}', [NodosController::class, 'update'])->name('updateNodo');
    Route::delete('/nodo/{id}', [NodosController::class, 'destroy'])->name('destroyNodo');

    Route::get('/poolevento', [PoolEventoController::class, 'index'])->name('indexPoolEvent');
    Route::get('/poolevento/{id}', [PoolEventoController::class, 'show'])->name('showPoolEvent');
    Route::post('/poolevento', [PoolEventoController::class, 'store'])->name('storePoolEvent');
    Route::put('/poolevento/{id}', [PoolEventoController::class, 'update'])->name('updatePoolEvent');
    Route::delete('/poolevento/{id}', [PoolEventoController::class, 'destroy'])->name('destroyPoolEvent');
    Route::get('/pools/{poolId}/evento', [PoolEventoController::class, 'getEventoByPool'])->name('getEventoByPool');
    Route::get('/eventos/{eventoId}/pools', [PoolEventoController::class, 'getPoolsByEvento'])->name('getPoolsByEvento');

    Route::get('/servidor', [ServidoresController::class, 'index'])->name('indexServer');
    Route::get('/servidor/{id}', [ServidoresController::class, 'show'])->name('showServer');
    Route::post('/servidor', [ServidoresController::class, 'store'])->name('storeServer');
    Route::put('/servidor/{id}', [ServidoresController::class, 'update'])->name('updateServer');
    Route::delete('/servidor/{id}', [ServidoresController::class, 'destroy'])->name('destroyServer');
    Route::get('/servidor/{servidorId}/nodo', [ServidoresController::class, 'getNodoByServidor'])->name('getNodoByServidor');
    Route::get('/nodo/{nodoId}/servidores', [ServidoresController::class, 'getServidoresByNodo'])->name('getServidoresByNodo');

    Route::get('/estatus', [EstatusController::class, 'index'])->name('indexEstatus');
    Route::get('/estatus/{id}', [EstatusController::class, 'show'])->name('showEstatus');
    Route::post('/estatus', [EstatusController::class, 'store'])->name('storeEstatus');
    Route::put('/estatus/{id}', [EstatusController::class, 'update'])->name('updateEstatus');
    Route::delete('/estatus/{id}', [EstatusController::class, 'destroy'])->name('destroyEstatus');

    Route::get('/estatusDetail', [EstatusServidoresController::class, 'index'])->name('indexEstatuDetail');
    Route::get('/estatusDetail/{id}', [EstatusServidoresController::class, 'show'])->name('showEstatuDetail');
    Route::get('/estatusDetail/{estatusId}/servidores', [EstatusServidoresController::class, 'getServersByEstatus'])->name('getServersByEstatusEstatuDetail');
    Route::post('/estatusDetail', [EstatusServidoresController::class, 'store'])->name('store');
    Route::put('/estatusDetail/{id}', [EstatusServidoresController::class, 'update'])->name('updateEstatuDetail');
    Route::delete('/estatusDetail/{id}', [EstatusServidoresController::class, 'destroy'])->name('destroyEstatuDetail');

    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('indexNotify');
    Route::post('/notificaciones', [NotificacionController::class, 'store'])->name('storeNotify');
});


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
