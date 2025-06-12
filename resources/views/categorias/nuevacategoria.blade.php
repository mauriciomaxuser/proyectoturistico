@extends('layout.app')
@section('contenido')
<form action="{{ route('categorias.store') }}"
        method="post">

    @csrf
    <h1>Registrar Nueva Categoría</h1>
    <label for=""><b>Nombre Categoría:</b></label><br>
    <input class="form-control"type="text" name="nombre" id="nombre"> <br> <br>
    
    
    <button  class="btn btn-success" type="submit">Guardar</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <a class="btn btn-outline-danger" href="{{ route('categorias.index') }}">Cancelar</a>
</form>
@endsection