@extends('layout.app')

@section('contenido')
<form id="form_categoria" action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')

    <h1>Editar Categoría</h1>

    <label for="nombre"><b>Nombre Categoría:</b></label><br>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}"><br>

    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a class="btn btn-outline-danger" href="{{ route('categorias.index') }}">Cancelar</a>
</form>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#form_categoria').validate({
                rules: {
                    nombre: {
                        required: true
                    }
                },
                messages: {
                    nombre: {
                        required: "Por favor ingrese un nombre de categoría"
                    }
                }
            });
        });
    </script>
@endsection
