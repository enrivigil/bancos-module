<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BancoController;
use App\Http\Controllers\CuentaBancariaController;
use App\Http\Controllers\ChequeraController;
use App\Http\Controllers\ChequeController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\MovimientoBancarioController;
use App\Http\Controllers\ConciliacionBancariaController;

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
    return view('welcome');
});

Route::prefix('bancos')->group(function () {
    Route::get('/', [BancoController::class, 'index']);
    Route::get('/agregar', [BancoController::class, 'agregar']);
    Route::post('/agregar', [BancoController::class, 'guardar']);
});

Route::prefix('cuentas-bancarias')->group(function () {
    Route::get('/', [CuentaBancariaController::class, 'index']);
    Route::get('/{id}/detalles', [CuentaBancariaController::class, 'detalles']);
    Route::get('/agregar', [CuentaBancariaController::class, 'agregar']);
    Route::post('/agregar', [CuentaBancariaController::class, 'guardar']);
});

Route::prefix('chequeras')->group(function () {
    Route::get('/', [ChequeraController::class, 'index']);
    Route::get('/{id}/detalles', [ChequeraController::class, 'detalles']);
    Route::get('/agregar', [ChequeraController::class, 'agregar']);
    Route::post('/agregar', [ChequeraController::class, 'guardar']);
});

Route::prefix('cheques')->group(function () {
    Route::get('/', [ChequeController::class, 'index']);
    Route::get('/{id}/detalles', [ChequeController::class, 'detalles']);
    Route::get('/agregar', [ChequeController::class, 'agregar']);
    Route::post('/agregar', [ChequeController::class, 'guardar']);
});

Route::prefix('transacciones')->group(function () {
    Route::get('/', [TransaccionController::class, 'index']);
    Route::get('/{id}/detalles', [TransaccionController::class, 'detalles']);
    Route::get('/agregar', [TransaccionController::class, 'agregar']);
    Route::post('/agregar', [TransaccionController::class, 'guardar']);
});

Route::prefix('movimientos-bancarios')->group(function () {
    Route::get('/', [MovimientoBancarioController::class, 'index']);
});

Route::prefix('conciliaciones-bancarias')->group(function () {
    Route::get('/', [ConciliacionBancariaController::class, 'index']);
    Route::get('/{id}/detalles', [ConciliacionBancariaController::class, 'detalles']);
    Route::get('/agregar', [ConciliacionBancariaController::class, 'agregar']);
    Route::post('/agregar', [ConciliacionBancariaController::class, 'guardar']);
});