@extends('layout.app')
@section('contenido')
<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">

    @csrf
    @method('PUT')
    <h1>Editar Categoría</h1>
    <label for=""><b>Nombre Categoría:</b></label><br>
    <input class="form-control" type="text" name="nombre" value="{{ $categoria->nombre }}"><br>
    
    
    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a class="btn btn-outline-danger" href="{{ route('categorias.index') }}">Cancelar</a>
</form>
@endsection