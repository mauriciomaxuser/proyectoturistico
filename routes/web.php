<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LugarturisticoController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/lugares/lugares', [LugarturisticoController::class, 'lugares'])->name('lugares.lugares');
Route::get('/layout/index', [LugarturisticoController::class, 'layout'])->name('layout.index');

Route::get('/mapas/mapa', [LugarturisticoController::class, 'mapas']);

Route::resource('categorias',CategoriaController::class);
Route::resource('lugares',LugarturisticoController::class);
