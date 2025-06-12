<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;


Route::get('/', function () {
    return view('welcome');
});
//Route::get('/categorias', [CategoriaController::class, 'mapa']);
//habilitando acceso a controlador
Route::resource('categorias',CategoriaController::class);