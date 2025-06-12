<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }//

    public function create()
    {
        return view('categorias.nuevacategoria');


        //
    }
    //guardar nuevo recurso en la bdd
    public function store(Request $request)
    {
        $datos=[
            'nombre'=>$request->nombre,
        ];
        Categoria::create($datos);
        return redirect()->route('categorias.index');
        //
    }

    //editar categorias
    public function edit(string $id)
    {
        
        $categoria = Categoria::findOrFail($id);
        return view('categorias.editarcategoria', compact('categoria'));
    //
    }
    //funcion actualizar
    public function update(Request $request, string $id)
    {
        
        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizado correctamente.');//
    }

    
}
