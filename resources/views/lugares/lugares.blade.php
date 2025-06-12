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
                    <td>
                        @if($lugarTemporal->imagen)
                            <img src="{{ asset('storage/' . $lugarTemporal->imagen) }}" alt="Imagen" width="100">
                        @else
                            Sin imagen
                        @endif
                    </td>

                    <td>{{ $lugarTemporal->latitud }}</td>
                    <td>{{ $lugarTemporal->longitud }}</td>



                    
                   <td>
                        <a href="{{ route('lugares.edit', $lugarTemporal->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fa fa-pen"></i>
                        </a>

                        <!-- Botón eliminar con SweetAlert -->
                        <button onclick="eliminarLugar({{ $lugarTemporal->id }})" class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>

                        <!-- Formulario oculto -->
                        <form id="formEliminarLugar{{ $lugarTemporal->id }}"
                              action="{{ route('lugares.destroy', $lugarTemporal->id) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>

                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
    <script>
        function eliminarLugar(id) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡Esta acción no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formEliminarLugar' + id).submit();
                }
            });
        }
    </script>
@endsection
