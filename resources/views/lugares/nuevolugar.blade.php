@extends('layout.app')
@section('contenido')
<form id="form_lugar" action="{{ route('lugares.store') }}" method="post" enctype="multipart/form-data">


    @csrf
    <h1>Registrar Nuevo Lugar</h1>
    <label for=""><b>Nombre:</b></label><br>
    <input class="form-control"type="text" name="nombre" id="nombre"> <br> <br>
    <label for=""><b>Descripción:</b></label><br>
    <input class="form-control"type="text" name="descripcion" id="descripcion"> <br> <br>
    <label for="categoria"><b>Categoría:</b></label><br>
    <select class="form-control" name="categoria" id="categoria" required>
        <option value="">Seleccione una categoría</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
        @endforeach
    </select>
    <br><br>

    
    
    
    <label for=""><b>Imagen:</b></label><br>
    <input class="form-control"type="file" name="imagen" id="imagen"> <br> <br>
    <label for=""><b>Latitud:</b></label><br>
    <input class="form-control"type="text" name="latitud" id="latitud" readonly> <br> <br>
    <label for=""><b>Longitud:</b></label><br>
    <input class="form-control"type="text" name="longitud" id="longitud" readonly> <br> <br>
    <br>
    <div class="" id="mapa_cliente" style="border:1px solid black; height:400px;
        width:100%"> </div>
    <br>
    
    <button  class="btn btn-success" type="submit">Guardar</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <a class="btn btn-outline-danger" href="{{ route('lugares.lugares') }}">Cancelar</a>
</form>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0qMP6QpknxzQtVxvF-JT3DVvZ00O0_7k&libraries=places&callback=initMap"></script>



<script type="text/javascript">
  

      function initMap() {
        var latitud_longitud = new google.maps.LatLng(-1.396900, -78.424400);
        var mapa = new google.maps.Map(document.getElementById('mapa_cliente'), {
            center: latitud_longitud,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marcador = new google.maps.Marker({
            position: latitud_longitud,
            map: mapa,
            title: "Ubicación seleccionada",
            draggable: true
        });

        document.getElementById("latitud").value = latitud_longitud.lat();
        document.getElementById("longitud").value = latitud_longitud.lng();

        // Al arrastrar el marcador
        marcador.addListener('dragend', function(event) {
            var latitud = event.latLng.lat();
            var longitud = event.latLng.lng();
            document.getElementById("latitud").value = latitud;
            document.getElementById("longitud").value = longitud;
        });

        // Al hacer clic en el mapa
        mapa.addListener('click', function(event) {
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
        $('#form_lugar').validate({
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
                imagen: {
                    required: true,
                    extension: "jpg|jpeg|png|gif"
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
                imagen: {
                    required: "Por favor seleccione una imagen",
                    extension: "Solo se permiten archivos JPG, JPEG, PNG o GIF"
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

