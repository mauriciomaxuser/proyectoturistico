@extends('layout.app')

@section('contenido')
    <h1>Listado de categoría</h1>
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('categorias.create') }}" class="btn btn-success">Agregar Nueva Categoría</a>
    </div>

    <table  class="table table-bordered 
     table-striped table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>OPCIONES</th>

            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoriaTemporal)
                <tr>
                    <td>{{ $categoriaTemporal->nombre }}</td>
                    
                   <td>
                        <a href="{{ route('categorias.edit', $categoriaTemporal->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fa fa-pen"></i>
                        </a>

                        <form action="{{ route('categorias.destroy', $categoriaTemporal->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Eliminar" type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>

                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
