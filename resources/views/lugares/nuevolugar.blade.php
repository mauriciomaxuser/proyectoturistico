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
    <div class="form-control" id="mapa_cliente" style="border:1px solid black; height:400px;
        width:100%"> </div>
    <br>
    
    <button  class="btn btn-success" type="submit">Guardar</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <a class="btn btn-outline-danger" href="{{ route('lugares.lugares') }}">Cancelar</a>
</form>



<script type="text/javascript">
  

      function initMap(){
        //alert("mapa ok");
        var latitud_longitud= new google.maps.LatLng(-0.180653, -78.467838);
        var mapa=new google.maps.Map(
          document.getElementById('mapa_cliente'),
          {
            center:latitud_longitud,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          }
        );
        var marcador=new google.maps.Marker({
          position:latitud_longitud,
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
                        required: "Por favor ingrese el nombre del lugar"
                    }
                }
            });
        });
    </script>
@endsection
