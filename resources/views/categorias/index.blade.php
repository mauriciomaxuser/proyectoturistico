@extends('layout.app')

@section('contenido')

    <h1>Listado de categoría</h1>
    <div class="d-flex gap-2 mb-3 align-items-center">
        <a href="{{ route('categorias.create') }}" class="btn btn-success">Agregar Nueva Categoría</a>

        <!-- Filtro de categorías -->
        <select id="filtroCategoria" class="form-select w-auto">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <table id="tablaCategorias" class="table table-bordered table-striped table-hover">
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

                        <button onclick="eliminarCategoria({{ $categoriaTemporal->id }})"
                                class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>

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

        // Inicializa DataTable
        let table = new DataTable('#tablaCategorias', {
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            }
        });

        // Filtro personalizado
        document.getElementById('filtroCategoria').addEventListener('change', function () {
            let valorFiltro = this.value;
            table.search(valorFiltro).draw();
        });
    </script>
@endsection
