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

                        <!-- Botón eliminar con SweetAlert -->
                        <button onclick="eliminarCategoria({{ $categoriaTemporal->id }})"
                                class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>

                        <!-- Formulario oculto -->
                        <form id="formEliminar{{ $categoriaTemporal->id }}"
                              action="{{ route('categorias.destroy', $categoriaTemporal->id) }}"
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
    <!-- Incluye SweetAlert2 desde CDN -->

    <script>
        function eliminarCategoria(id) {
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
                    document.getElementById('formEliminar' + id).submit();
                }
            });
        }
    </script>
    @endsection

