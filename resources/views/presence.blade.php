@extends('adminlte::page')

@section('content_header')
    <h1>Histórico de Presença</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Presença</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
@if(auth()->user()->campus == "cam")
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Lançar Presença</h3>
            </div>
            <div class="box-body">
                <form role="form" method="POST" action="{{ route('presence.register') }}">
                    {!! csrf_field() !!}
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
                            <option value="USF Swift">USF - Campinas (Swift)</option>
                            <option value="USF Cambui">USF - Campinas (Cambuí)</option>
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
                    <button type="submit" class="form-control btn btn-success">Cadastrar</button>
                </form>
                <div class="box-footer align-center">
                    <div id="mapholder"></div>
                </div>    
            </div>
        </div>
    </div>
</div>
<script src="http://maps.google.com/maps/api/js"></script>
@endif
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Registro Pessoal</h3>
            </div>
            <div class="box-body">
                <table id="presences" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saída</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presences as $presence)
                        <tr>
                            <td>
                                @if(date('d/m/Y') == date('d/m/Y', strtotime($presence->checkIn)))
                                Hoje
                                @elseif(date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($presence->checkIn)))
                                Ontem
                                @else
                                {{ date('d/m/Y', strtotime($presence->checkIn)) }}
                                @endif
                            </td>
                            <td>{{ date('H:i', strtotime($presence->checkIn)) }}</td>
                            <td>
                                @if($presence->checkOut != NULL)
                                {{ date('H:i', strtotime($presence->checkOut)) }}
                                @else
                                ...
                                @endif
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Relatório Mensal</h3>
            </div>
            <div class="box-body">
                <p>Selecione abaixo o mês desejado para realizar o download de sua lista de presença.</p>
                <div class="row">
                    <form role="form" method="POST" action="{{ route('presence.list') }}" target="_blank">
                        {!! csrf_field() !!} 
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <?php setlocale (LC_ALL, 'pt_BR'); ?>
                            <select class="form-control" name="month">
                                <option value="{{ date('m', strtotime('now')) }}">{{ ucfirst(strftime('%B', strtotime('now'))) }}</option>
                                <option value="{{ date('m', strtotime('-1 month')) }}">{{ ucfirst(strftime('%B', strtotime('-1 month'))) }}</option>
                                <option value="{{ date('m', strtotime('-2 month')) }}">{{ ucfirst(strftime('%B', strtotime('-2 month'))) }}</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <button type="submit" class="btn btn-block btn-flat btn-primary"><i class="fa fa-fw fa-download"></i> Gerar</button>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(function () {
            $('#presences').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    }
                }
            });
        });

        var local = document.getElementById("local");
        var c_x = document.getElementById("c_x");
        var c_y = document.getElementById("c_y");

        function selectUsers()
        {
            if(local.selectedIndex == "1" && getDistanceFromLatLonInKm({lat: c_x.value, lng: c_y.value},{lat: -22.935201, lng: -47.034752}) >= 1500) 
            {
                alert("Você está muito distante do local selecionado!");
                local.selectedIndex = "3";
            }

            if(local.selectedIndex == "2" && getDistanceFromLatLonInKm({lat: c_x.value, lng: c_y.value},{lat: -22.894051, lng: -47.050259}) >= 1500) 
            {
                alert("Você está muito distante do local selecionado!");
                local.selectedIndex = "3";
            }
        }
        function getLocation()
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            } 
            else
            {
                local.innerHTML="Geolocalização não é suportada nesse browser.";
            }
        }
        function showPosition(position)
        {
            lat = position.coords.latitude;
            c_x.value = lat;

            lon = position.coords.longitude;
            c_y.value = lon;

            latlon=new google.maps.LatLng(lat, lon);
            mapholder=document.getElementById('mapholder');
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