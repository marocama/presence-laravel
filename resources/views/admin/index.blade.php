@extends('adminlte::page')

@section('content_header')
    <h1>Histórico de Presença</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Relatórios</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Registro Geral</h3>
            </div>
            <div class="box-body">
                <table id="presences" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Usuário</th>
                            <th scope="col">Data</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saída</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presences as $presence)
                            @if($presence->status == true)
                                <tr>
                                    <td>{{ $presence->user->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($presence->checkIn)) }}</td>
                                    <td>{{ date('H:i', strtotime($presence->checkIn)) }}</td>
                                    <td>
                                        @if($presence->checkOut != NULL)
                                            {{ date('H:i', strtotime($presence->checkOut)) }}
                                        @else
                                            ...
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4">Nenhum registro disponível.</td>
                            </tr>
                        @endforelse
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Balanço Mensal</h3>
            </div>
            <div class="box-body">
                <table id="presences" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Usuário</th>
                            <th scope="col">Total de Presenças</th>
                            <th scope="col">Horário Cumprido (hrs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($array as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value }}</td>
                                <td>{{ \Carbon\Carbon::parse($array2[$key])->format('H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Nenhum registro disponível.</td>
                            </tr>
                        @endforelse
                    </tfoot>
                </table>
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
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros dos últ. 3 meses",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_  Resultados por página",
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
    </script>
@stop