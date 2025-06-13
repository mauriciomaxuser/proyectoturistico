@extends('layout.app')

@section('contenido')
    <h1>Listado de Lugares Turisticos</h1>
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('lugares.create') }}" class="btn btn-success">Agregar Nuevo Lugar</a>
    </div>

    <table id="tablaLugares" class="table table-bordered table-striped table-hover">
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

                        <button onclick="eliminarLugar({{ $lugarTemporal->id }})" class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>

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

@section('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>

    <!-- Dependencias para exportar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        $(document).ready(function() {
            $('#tablaLugares').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
                },
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
@endsection
