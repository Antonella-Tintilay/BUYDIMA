<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reportes/productos', [ReporteProductoController::class, 'index'])
    ->name('reportes.productos');