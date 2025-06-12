<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugarturistico;

class LugarturisticoController extends Controller
{
    public function lugares()
    {
        $lugares = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }//
    //
}
