@extends('layout.app')

@section('contenido')
<form  id="form_lugar_editar"  action="{{ route('lugares.update', $lugar->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h1>Editar Lugar Turístico</h1>

    <label><b>Nombre:</b></label><br>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $lugar->nombre }}"> <br>

    <label><b>Descripción:</b></label><br>
    <input class="form-control" type="text" name="descripcion" id="descripcion" value="{{ $lugar->descripcion }}"> <br>

    <label><b>Categoría:</b></label><br>
    <select class="form-control" name="categoria" id="categoria">
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->nombre }}" {{ $categoria->nombre == $lugar->categoria ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    <br>

    <label><b>Imagen actual:</b></label><br>
    @if($lugar->imagen)
        <img src="{{ asset('storage/' . $lugar->imagen) }}" alt="Imagen actual" width="150"><br><br>
    @endif

    <label><b>Actualizar Imagen:</b></label><br>
    <input class="form-control" type="file" name="imagen" id="imagen"> <br>

    <label><b>Latitud:</b></label><br>
    <input class="form-control" type="text" name="latitud" id="latitud" value="{{ $lugar->latitud }}" readonly> <br>

    <label><b>Longitud:</b></label><br>
    <input class="form-control" type="text" name="longitud" id="longitud" value="{{ $lugar->longitud }}" readonly> <br>

    <br>
    <div class="" id="mapa_cliente" style="border:1px solid black; height:400px;
        width:100%"> </div>
    <br>

    <button class="btn btn-primary" type="submit">Actualizar</button>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-outline-danger" href="{{ route('lugares.lugares') }}">Cancelar</a>
</form>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0qMP6QpknxzQtVxvF-JT3DVvZ00O0_7k&libraries=places&callback=initMap"></script>


<script type="text/javascript">
    function initMap(){
        var latitud = parseFloat("{{ $lugar->latitud }}");
        var longitud = parseFloat("{{ $lugar->longitud }}"); 

        var latLng = new google.maps.LatLng(latitud, longitud);

        var mapa = new google.maps.Map(document.getElementById('mapa_cliente'), {
            center: latLng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marcador = new google.maps.Marker({
            position: latLng,
            map: mapa,
            title: "Seleccione la dirección",
            draggable: true
        });

        // Al arrastrar el marcador
        google.maps.event.addListener(marcador, 'dragend', function(event){
            var latitud = this.getPosition().lat();
            var longitud = this.getPosition().lng();
            document.getElementById("latitud").value = latitud;
            document.getElementById("longitud").value = longitud;
        });

        // Al hacer clic en el mapa
        google.maps.event.addListener(mapa, 'click', function(event){
            var latitud = event.latLng.lat();
            var longitud = event.latLng.lng();
            marcador.setPosition(event.latLng); // Mover marcador
            document.getElementById("latitud").value = latitud;
            document.getElementById("longitud").value = longitud;
        });
    }

</script>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#form_lugar_editar').validate({
            rules: {
                nombre: {
                    required: true,
                },
                descripcion: {
                    required: true,
                },
                categoria: {
                    required: true
                },
                
                latitud: {
                    required: true,
                    number: true
                },
                longitud: {
                    required: true,
                    number: true
                }
            },
            messages: {
                nombre: {
                    required: "Por favor ingrese el nombre del lugar",
                },
                descripcion: {
                    required: "Por favor ingrese una descripción",
                },
                categoria: {
                    required: "Seleccione una categoría"
                },
                
                latitud: {
                    required: "La latitud es requerida",
                    number: "La latitud debe ser un número válido"
                },
                longitud: {
                    required: "La longitud es requerida",
                    number: "La longitud debe ser un número válido"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('text-danger small');
                if (element.prop('type') === 'file') {
                    error.insertAfter(element.next('label'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@endsection