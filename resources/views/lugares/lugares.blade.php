@extends('layout.app')

@section('contenido')
    <h1>Listado de Lugares Turisticos</h1>
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('lugares.create') }}" class="btn btn-success">Agregar Nuevo Lugar</a>
    </div>

    <table  class="table table-bordered 
     table-striped table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>OPCIONES</th>

            </tr>
        </thead>
        <tbody>
            @foreach($lugares as $lugarTemporal)
                <tr>
                    <td>{{ $lugarTemporal->nombre }}</td>
                    <td>{{ $lugarTemporal->descripcion }}</td>
                    <td>{{ $lugarTemporal->categoria }}</td>
                    <td>{{ $lugarTemporal->imagen }}</td>
                    <td>{{ $lugarTemporal->latitud }}</td>
                    <td>{{ $lugarTemporal->longitud }}</td>



                    
                   <td>
                        <a href="{{ route('lugares.edit', $lugarTemporal->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fa fa-pen"></i>
                        </a>

                        <form action="{{ route('lugares.destroy', $lugarTemporal->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
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
