@extends('layout.app')

@section('contenido')
<br>
<h1>MAPA DE LUGARES TURISTICOS</h1><br>
<div id="mapa-lugares"
style="border:2px solid black;
height:500px; width:100%" >
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0qMP6QpknxzQtVxvF-JT3DVvZ00O0_7k&libraries=places&callback=initMap">
</script>

<script type="text/javascript">
    function initMap() {
        var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);
        var mapa = new google.maps.Map(document.getElementById('mapa-lugares'), {
            center: latitud_longitud,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        @foreach($mapas as $lugaresTemporal)
            (function() {
                var coordenadaCliente = new google.maps.LatLng({{ $lugaresTemporal->latitud }}, {{ $lugaresTemporal->longitud }});

                var marcador = new google.maps.Marker({
                    position: coordenadaCliente,
                    map: mapa,
                    icon: {
                        url: 'https://cdn-icons-png.flaticon.com/512/9683/9683128.png',
                        scaledSize: new google.maps.Size(60, 60)
                    },
                    title: "{{ $lugaresTemporal->nombre }}",
                    draggable: false
                });

                var contenido = `<div style="font-size:14px; max-width:250px;">
                    <strong>{{ $lugaresTemporal->nombre }}</strong><br>
                    {{ $lugaresTemporal->descripcion }}<br>
                    Categoría: {{ $lugaresTemporal->categoria }}<br>
                    <img src="{{ asset('storage/' . $lugaresTemporal->imagen) }}" alt="Imagen del lugar" style="width:100%; max-height:150px; object-fit:cover;"><br>
                    Latitud: {{ $lugaresTemporal->latitud }}<br>
                    Longitud: {{ $lugaresTemporal->longitud }}
                </div>`;



                var infoWindow = new google.maps.InfoWindow({
                    content: contenido
                });

                marcador.addListener('click', function () {
                    infoWindow.open(mapa, marcador);
                });
            })();
        @endforeach
    }
</script>

@endsection
