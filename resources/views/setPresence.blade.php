@extends('adminlte::page')

@section('content_header')
    <h1>Registrar Entrada</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Registrar Entrada</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <form role="form" method="POST" action="{{ route('setPresence.confirm') }}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label for="nameEvent">Coordenadas X</label>
                                <input type="text" class="form-control" id="c_x" name="c_x" value="0" readonly>
                            </div>
                            <div class="col-xs-6">
                                <label for="nameEvent">Coordenadas Y</label>
                                <input type="text" class="form-control" id="c_y" name="c_y" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Local</label>
                        <select required class="form-control" name="local" id="local" onclick="getLocation()" onchange="selectUsers()">
                            <option disabled selected>Selecione</option>
                            <option value="USF">USF</option>
                            <option value="Prefeitura de Piracaia">Prefeitura de Piracaia</option>
                            <option value="Prefeitura de Pedra Bela">Prefeitura de Pedra Bela</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label>Data</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="dateEvent" name="date" value="{{ date('d/m/Y') }}" readonly>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <label>Horário</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="time" class="form-control" id="timeEvent" name="time" value="{{ date('H:i') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="divfun">
                        <label>Selecione os estágiarios presentes na sala neste momento:</label>
                        <select class="js-example-basic-multiple" id="funcCheckin" name="states[]" value="" multiple="multiple" style="width: 100%">
                            @forelse($names as $name)
                                @if ($name->name != $user)
                                    <option>{{ $name->name }}</option>
                                @endif
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="form-control btn btn-success">Cadastrar</button>
                </div>
                <div class="box-footer align-center">
                    <div id="mapholder"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{Config::get('app.url')}}/node_modules/select2/dist/js/select2.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
@stop

@section('js')
    <script>
        $('.js-example-basic-multiple').select2({
            placeholder: 'Selecione..',
            language: 'pt-BR'
        });

        function selectUsers()
        {
            if(document.getElementById('local').value == "USF" && getDistanceFromLatLonInKm(
                {lat: document.getElementById('c_x').value, lng: document.getElementById('c_y').value},
                {lat: -22.978324, lng: -46.534378}
            ) >= 1000) {
                alert("Você está muito distante do local selecionado!");
                //document.getElementById('local').value = "Outro";
            }

            var local = document.getElementById("local");
            if (local.selectedIndex != 1) 
            {
                document.getElementById('divfun').style.display = "none";  
            } 
            else
            {
                document.getElementById('divfun').style.display = "inline";  
            } 
        }

        var x = document.getElementById("local");

        function getLocation()
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            } 
            else
            {
                x.innerHTML="Geolocalização não é suportada nesse browser.";
            }
        }
        
        function showPosition(position)
        {
            lat=position.coords.latitude;
            document.getElementById('c_x').value = lat;
            lon=position.coords.longitude;
            document.getElementById('c_y').value = lon;
            latlon=new google.maps.LatLng(lat, lon)
            mapholder=document.getElementById('mapholder')
            mapholder.style.height='250px';
            mapholder.style.width='100%';
            
            var myOptions = {
                center:latlon,zoom:14,
                mapTypeId:google.maps.MapTypeId.ROADMAP,
                mapTypeControl:false,
                navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
            };

            var map = new google.maps.Map(document.getElementById("mapholder"),myOptions);
            var marker = new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});

        }
        
        function showError(error)
        {
            switch(error.code) 
            {
                case error.PERMISSION_DENIED:
                    x.innerHTML="Usuário rejeitou a solicitação de Geolocalização."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML="Localização indisponível."
                    break;
                case error.TIMEOUT:
                    x.innerHTML="O tempo da requisição expirou."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML="Algum erro desconhecido aconteceu."
                    break;
            }
        }

        function getDistanceFromLatLonInKm(position1, position2)
        {
            "use strict";
            var deg2rad = function (deg) { return deg * (Math.PI / 180); },
            R = 6371,
            dLat = deg2rad(position2.lat - position1.lat),
            dLng = deg2rad(position2.lng - position1.lng),
            a = Math.sin(dLat / 2) * Math.sin(dLat / 2)
                + Math.cos(deg2rad(position1.lat))
                * Math.cos(deg2rad(position1.lat))
                * Math.sin(dLng / 2) * Math.sin(dLng / 2),
            c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return ((R * c *1000).toFixed());
        }

    </script>
@stop
