@extends('layout.app')

@section('contenido')
<form action="{{ route('lugares.update', $lugar->id) }}" method="post" enctype="multipart/form-data">
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
    <div class="form-control" id="mapa_cliente" style="border:1px solid black; height:400px;
        width:100%"> </div>
    <br>

    <button class="btn btn-primary" type="submit">Actualizar</button>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-outline-danger" href="{{ route('lugares.lugares') }}">Cancelar</a>
</form>


<script type="text/javascript">
    function initMap(){
        //alert("mapa ok");
        var latitud = parseFloat("{{ $lugar->latitud }}")
        var longitud = parseFloat("{{ $lugar->longitud }}") 

        var latLng = new google.maps.LatLng(latitud, longitud);

        var mapa = new google.maps.Map(document.getElementById('mapa_cliente'), {
            center: latLng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
        );
        var marcador=new google.maps.Marker({
          position:latLng,
          map:mapa,
          title:"Seleccione la direccion",
          draggable:true //aqui se puede arrasttrar
        });
        google.maps.event.addListener(
          marcador,
          'dragend', //cuandose suelta se ejecuta captura latitud y longitud de marcador
          function(event){
            var latitud=this.getPosition().lat();
            var longitud=this.getPosition().lng();
            /*alert("LATITUD: "+latitud);
            alert("LONGITUD: "+longitud);*/
            document.getElementById("latitud").value=latitud;
            document.getElementById("longitud").value=longitud;
          }
        );
      }
</script>
@endsection
