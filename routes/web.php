<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/cliente', function () {
    return view('cliente');
});
