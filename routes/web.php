<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LugarturisticoController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/lugares/lugares', [LugarturisticoController::class, 'lugares']);

Route::resource('categorias',CategoriaController::class);
Route::resource('lugares',LugarturisticoController::class);