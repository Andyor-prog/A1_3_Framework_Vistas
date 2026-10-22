<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CarritoDetalleController;
use App\Http\Controllers\HistorialTransaccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('home');

Route::resource('usuarios', UsuarioController::class)->except('show');
Route::resource('carritos', CarritoController::class)->except('show');
Route::resource('carrito-detalles', CarritoDetalleController::class)->except('show');
Route::resource('historial-transacciones', HistorialTransaccionController::class)->except('show');
Route::resource('users', UserController::class)->except('show');

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/cliente', function () {
    return view('cliente');
});
