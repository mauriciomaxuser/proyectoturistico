<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugarturistico;
use App\Models\Categoria;


class LugarturisticoController extends Controller
{
    public function lugares()
    {
        $lugares = Lugarturistico::all();

        return view('lugares.lugares', compact('lugares'));
    }


    public function mapas()
    {
        $mapas = Lugarturistico::all(); 
        return view('mapas.mapas', compact('mapas'));
    }
    //
    public function create()
    {
        $categorias = Categoria::all(); // Traemos todas las categorías
        return view('lugares.nuevolugar', compact('categorias'));


        //
    }

    //guardar nuevo recurso en la bdd
    public function store(Request $request)
    {
        $datos=[
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'categoria'=>$request->categoria,
            'imagen'=>$request->imagen,
            'latitud'=>$request->latitud,
            'longitud'=>$request->longitud,

        ];
        Lugarturistico::create($datos);
        return redirect()->route('lugares.lugares');
        //
    }
}
