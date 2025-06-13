<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugarturistico;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;



class LugarturisticoController extends Controller
{
    public function lugares()
    {
        $lugares = Lugarturistico::all();

        // Obtener las categorías únicas desde los lugares
        $categoriasUnicas = $lugares->pluck('categoria')->unique()->sort()->values();

        return view('lugares.lugares', compact('lugares', 'categoriasUnicas'));
    }



    public function mapas()
    {
        $mapas = Lugarturistico::all(); 
        return view('mapas.mapas', compact('mapas'));
    }
    public function layout()
    {
        return view('layout.index'); 
    }
    //
    public function create()
    {
        $categorias = Categoria::all();
        

        return view('lugares.nuevolugar', compact('categorias'));
    }


    //guardar nuevo recurso en la bdd
    public function store(Request $request)
    {
        // Subir imagen sin validación
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('imagenes', 'public'); // guarda en storage/app/public/imagenes
        }

        $datos = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'imagen' => $rutaImagen,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ];

        Lugarturistico::create($datos);
        return redirect()->route('lugares.lugares');
    }

    public function edit($id)
    {
        $lugar = Lugarturistico::findOrFail($id);
        $categorias = Categoria::all();
        return view('lugares.editarlugar', compact('lugar', 'categorias'));

    }


    public function update(Request $request, $id)
    {
        $lugar = Lugarturistico::findOrFail($id);

        $datos = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ];

        if ($request->hasFile('imagen')) {
            // Borra imagen anterior si existe
            if ($lugar->imagen && Storage::disk('public')->exists($lugar->imagen)) {
                Storage::disk('public')->delete($lugar->imagen);
            }
            // Guarda nueva imagen
            $datos['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        $lugar->update($datos);
        return redirect()->route('lugares.lugares')->with('success', 'Lugar actualizado correctamente.');
    }


    //funcion para eliminar
    public function destroy(string $id)
    {
        
        $lugar = Lugarturistico::findOrFail($id);
        $lugar->delete(); 

        return redirect()->route('lugares.lugares')->with('success', 'Lugar eliminado correctamente.');
        //
    }
}
